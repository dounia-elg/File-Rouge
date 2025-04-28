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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * Format the duration in hours and minutes
     */
    public function getFormattedDurationAttribute()
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;
        
        if ($hours > 0) {
            return sprintf('%d:%02d', $hours, $minutes);
        }
        
        return sprintf('%d:%02d', 0, $minutes);
    }

    /**
     * Get YouTube video ID from the video link
     */
    public function getYoutubeIdAttribute()
    {
        $videoId = null;
        $url = $this->video_link;
        
        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtu\.be\/([^?]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtube\.com\/embed\/([^?]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }
        
        return $videoId;
    }
    
    /**
     * Get the YouTube thumbnail URL
     */
    public function getVideoThumbnailAttribute()
    {
        if ($this->youtube_id) {
            return "https://img.youtube.com/vi/{$this->youtube_id}/mqdefault.jpg";
        }
        
        return null;
    }

    /**
     * Get the registrations for the workshop.
     */
    public function registrations()
    {
        return $this->hasMany(WorkshopRegistration::class);
    }
} 