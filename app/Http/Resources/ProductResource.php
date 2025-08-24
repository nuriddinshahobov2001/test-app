<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type->name,
            'category' => $this->category->name,
            'brand' => $this->brand->name,
            'currency' => $this->currency->name,
            'selling_price' => $this->selling_price,
            'purchase_price' => $this->purchase_price,
            'quantity' => $this->total_stock,
            'product_margin' => (float)$this->purchase_price - (float)$this->selling_price,
        ];
    }
}
