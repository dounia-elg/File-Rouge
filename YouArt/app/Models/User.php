<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'location',
        'bio',
        'position',
        'profile_image',
        'followers',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the artworks for the user.
     */
    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }

    /**
     * Check if user is an artist
     */
    public function isArtist()
    {
        return $this->role === 'artist';
    }

    /**
     * Check if user is an art lover
     */
    public function isArtLover()
    {
        return $this->role === 'art_lover';
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Artworks liked by the user
     */
    public function likedArtworks()
    {
        return $this->belongsToMany(Artwork::class, 'artwork_likes')->withTimestamps();
    }

    /**
     * Workshops liked by the user
     */
    public function likedWorkshops()
    {
        return $this->belongsToMany(\App\Models\Workshop::class, 'workshop_likes')->withTimestamps();
    }

    /**
     * Artists this user is following (for art lovers)
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }

    /**
     * Users following this artist
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
    }

    /**
     * Check if this user is following another user
     */
    public function isFollowing($user)
    {
        return $this->following()->where('followed_id', $user->id)->exists();
    }

    /**
     * Check if this user is followed by another user
     */
    public function isFollowedBy($user)
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }
}