<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingExtra extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'extra_id', 'price_at_booking'];

    protected $casts = [
        'price_at_booking' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function extra()
    {
        return $this->belongsTo(Extra::class);
    }
}
