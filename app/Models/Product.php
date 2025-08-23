<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'product_type_id',
        'brand_id',
        'category_id',
        'currency_id',
        'sku'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function locations()
    {
        return $this->hasMany(ProductLocation::class, 'product_id');
    }

    public function currency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id');
    }

    public function combos()
    {
        return $this->hasMany(ProductCombo::class, 'product_id');
    }

    public function photos()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
