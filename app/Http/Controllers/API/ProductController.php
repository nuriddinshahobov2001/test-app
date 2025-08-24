<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Productresource;
use App\Services\API\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        readonly private ProductService $productService
    )
    {
    }

    public function count()
    {
        return response()->json([
            'Общий запас по всем продуктам' => $this->productService->calculateTotalStock(),
            'Общая сумма продажной стоимости' => $this->productService->calculateTotalPurchase(),
            'Общая сумма закупочной стоимости' => $this->productService->calculateTotalSelling(),
        ]);
    }

    public function products()
    {
        return response()->json(
            ProductResource::collection($this->productService->products())
        );
    }
}
