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
        'category',
        'description',
        'price',
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
} 