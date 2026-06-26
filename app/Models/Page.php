<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'slug', 'title', 'content', 'meta_title', 'meta_description',
    ];

    protected array $translatable = ['title', 'content', 'meta_title', 'meta_description'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
