<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image', // Path to the portfolio image
        'github_link', // Link to GitHub repository
        'demo_link', // Link to live demo
    ];

    /**
     * User pemilik portofolio.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
