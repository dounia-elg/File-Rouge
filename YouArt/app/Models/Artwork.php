<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'dimensions',
        'image_path',
        'views',
        'likes',
        'is_sold',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'views' => 'integer',
        'likes' => 'integer',
        'is_sold' => 'boolean',
    ];

    /**
     * Get the user that owns the artwork.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Users who liked this artwork
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'artwork_likes')->withTimestamps();
    }

    /**
     * Check if a user liked this artwork
     */
    public function isLikedBy($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    /**
     * Get the payment for this artwork
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    
    /**
     * Get the buyer of this artwork
     */
    public function buyer()
    {
        return $this->payment ? $this->payment->user : null;
    }
} 