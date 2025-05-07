<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'artwork_id',
        'stripe_payment_id',
        'amount',
        'currency',
        'status',
        'payment_details'
    ];

    protected $casts = [
        'payment_details' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }
}
