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


    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }


    public function isArtist()
    {
        return $this->role === 'artist';
    }


    public function isArtLover()
    {
        return $this->role === 'art_lover';
    }


    public function isAdmin()
    {
        return $this->role === 'admin';
    }


    public function likedArtworks()
    {
        return $this->belongsToMany(Artwork::class, 'artwork_likes')->withTimestamps();
    }


    public function likedWorkshops()
    {
        return $this->belongsToMany(\App\Models\Workshop::class, 'workshop_likes')->withTimestamps();
    }


    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }


    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
    }


    public function isFollowing($user)
    {
        return $this->following()->where('followed_id', $user->id)->exists();
    }

    
    public function isFollowedBy($user)
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }
}
