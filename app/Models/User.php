<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

   protected $fillable = [
        'name',
        'username',
        'nim',           // <--- TAMBAHKAN INI
        'email',
        'password',
        'profile_photo',
        'bio',
        'website',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // === RELATIONS ===
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
 
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')
            ->withTimestamps();
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')
            ->withTimestamps();
    }
    
    // === FOLLOW METHODS ===
    public function isFollowing(User $user): bool
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    public function isFollowedBy(User $user): bool
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }

    public function follow(User $user): bool
    {
        // Prevent self-follow
        if ($this->id === $user->id) {
            return false;
        }
        
        $this->following()->syncWithoutDetaching([$user->id]);
        return true;
    }

    public function unfollow(User $user): bool
    {
        return $this->following()->detach($user->id) > 0;
    }

    // === LIKE METHODS ===
    public function hasLiked(Post $post): bool
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }

    // === ACCESSORS ===
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo) {
            return asset('storage/' . $this->profile_photo);
        }
        
        // Fallback to default avatar
        return asset('images/default-avatar.png');
    }

    public function getInitialsAttribute(): string
    {
        $names = explode(' ', $this->full_name);
        $initials = '';
        
        if (count($names) >= 2) {
            $initials = strtoupper($names[0][0] . $names[1][0]);
        } else {
            $initials = strtoupper(substr($this->full_name, 0, 2));
        }
        
        return $initials;
    }

    // === SCOPES ===
    public function scopeStudents($query)
    {
        return $query->where('category', 'student');
    }

    public function scopeAlumni($query)
    {
        return $query->where('category', 'alumni');
    }

    public function scopeByMajor($query, $major)
    {
        return $query->where('major', $major);
    }

    public function scopeByGeneration($query, $generation)
    {
        return $query->where('generation', $generation);
    }

    // === HELPER METHODS ===
    public function getPostCountAttribute(): int
    {
        return $this->posts()->count();
    }

    public function getFollowerCountAttribute(): int
    {
        return $this->followers()->count();
    }

    public function getFollowingCountAttribute(): int
    {
        return $this->following()->count();
    }

    // === BOOT METHOD ===
    protected static function boot()
    {
        parent::boot();

        // Auto-create username if not provided
        static::creating(function ($user) {
            if (empty($user->username)) {
                $baseUsername = strtolower(str_replace(' ', '', $user->full_name));
                $username = $baseUsername;
                $counter = 1;
                
                while (static::where('username', $username)->exists()) {
                    $username = $baseUsername . $counter;
                    $counter++;
                }
                
                $user->username = $username;
            }
        });
    }
}