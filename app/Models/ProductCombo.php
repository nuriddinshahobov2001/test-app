<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCombo extends Model
{
    protected $fillable = ['product_id', 'combo_id', 'quantity'];
}
