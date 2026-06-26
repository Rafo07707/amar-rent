<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number', 'car_id', 'location_id', 'customer_name',
        'customer_phone', 'customer_email', 'pickup_date', 'return_date',
        'total_amount', 'payment_method', 'crypto_txid',
        'additional_driver', 'child_seat', 'gps', 'notes', 'status', 'locale',
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'return_date' => 'date',
        'total_amount' => 'decimal:2',
        'additional_driver' => 'boolean',
        'child_seat' => 'boolean',
        'gps' => 'boolean',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function bookingExtras()
    {
        return $this->hasMany(BookingExtra::class);
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'booking_extras')->withPivot('price_at_booking');
    }

    public function getTotalExtrasAttribute(): float
    {
        return (float) $this->bookingExtras->sum('price_at_booking');
    }

    /**
     * Real bookings: created via the Booking page, always have a car attached.
     */
    public function scopeBookings($query)
    {
        return $query->whereNotNull('car_id');
    }

    /**
     * Contact inquiries: created via the plain Contact form, never have a car attached.
     */
    public function scopeInquiries($query)
    {
        return $query->whereNull('car_id');
    }

    public static function generateBookingNumber(): string
    {
        return 'BX-' . now()->format('ymd') . '-' . strtoupper(substr(uniqid(), -5));
    }
}
