<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'key', 'name', 'description', 'icon', 'price', 'currency',
        'pricing_type', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    protected array $translatable = ['name', 'description'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Calculate the price of this extra for a given number of rental days.
     */
    public function priceForDays(int $days): float
    {
        $days = max(1, $days);

        return $this->pricing_type === 'per_day'
            ? (float) $this->price * $days
            : (float) $this->price;
    }
}
