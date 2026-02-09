<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'features',
        'price',
        'original_price',
        'demo_link',
        'download_link',
        'thumbnail',
        'category',
        'tech_stack',
        'sales_count',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:0',
        'original_price' => 'decimal:0',
        'is_active' => 'boolean'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
