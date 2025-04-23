<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
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
        'video_link',
        'skill_level',
        'views',
        'likes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'views' => 'integer',
        'likes' => 'integer',
    ];

    /**
     * Get the registrations for the workshop.
     */
    public function registrations()
    {
        return $this->hasMany(WorkshopRegistration::class);
    }
} 