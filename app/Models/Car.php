<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'slug', 'name', 'description', 'category', 'transmission',
        'fuel_type', 'seats', 'bags', 'price_per_day', 'deposit_amount',
        'included_km_per_day', 'currency', 'image',
        'is_active', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price_per_day' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
    ];

    /**
     * Fields that return a localized string via the magic accessor.
     */
    protected array $translatable = ['name', 'description'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'car_location');
    }

    public function scopeAtLocation($query, ?string $locationSlug)
    {
        if (!$locationSlug) {
            return $query;
        }

        return $query->whereHas('locations', function ($q) use ($locationSlug) {
            $q->where('slug', $locationSlug);
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfCategory($query, ?string $category)
    {
        if (!$category || $category === 'all') {
            return $query;
        }

        return $query->where('category', $category);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return asset('assets/images/car-placeholder.svg');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
