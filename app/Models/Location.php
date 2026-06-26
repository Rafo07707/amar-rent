<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'slug', 'name', 'description', 'address', 'working_hours',
        'icon', 'latitude', 'longitude', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    protected array $translatable = ['name', 'description', 'address', 'working_hours'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_location');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
