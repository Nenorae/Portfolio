<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Skill;
use App\Models\Portfolio;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',

        // Tambahan untuk profil publik
        'username',
        'bio',
        'major',
        'generation',
        'profile_photo',
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

    // Relasi Keahlian
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    // Relasi Portofolio
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}

