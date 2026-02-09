<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'price' => 'decimal:0',
        'original_price' => 'decimal:0',
        'is_active' => 'boolean'
    ];

    protected function features(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (is_array($value)) {
                    return $value;
                }

                if (is_string($value)) {
                    $decoded = json_decode($value, true);
                    if (is_array($decoded)) {
                        return $decoded;
                    }

                    if (is_string($decoded)) {
                        $decodedTwice = json_decode($decoded, true);
                        if (is_array($decodedTwice)) {
                            return $decodedTwice;
                        }
                    }
                }

                return [];
            },
            set: function ($value) {
                if (is_array($value)) {
                    return json_encode($value, JSON_UNESCAPED_UNICODE);
                }

                if (is_string($value)) {
                    $decoded = json_decode($value, true);
                    if (is_array($decoded)) {
                        return json_encode($decoded, JSON_UNESCAPED_UNICODE);
                    }
                }

                return json_encode([], JSON_UNESCAPED_UNICODE);
            }
        );
    }

    protected function downloadLink(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value) {
                    return null;
                }

                if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
                    return $value;
                }

                $base = rtrim(config('app.download_base_url', config('app.url')), '/');

                return $base . '/' . ltrim($value, '/');
            }
        );
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
