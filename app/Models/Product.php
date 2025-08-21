<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'product_type_id', 'brand_id', 'category_id', 'currency_id', 'sku'];

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
}
