<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLocation extends Model
{
    protected $fillable = ['product_id', 'location_name', 'selling_price', 'purchase_price', 'stock'];
}
