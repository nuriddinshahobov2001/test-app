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
            'total_stock' => $this->productService->calculateTotalStock(),
            'total_purchase_amount' => $this->productService->calculateTotalPurchase(),
            'total_selling_amount' => $this->productService->calculateTotalSelling(),
        ]);
    }

    public function products()
    {
        return response()->json(
            ProductResource::collection($this->productService->products())
        );
    }
}
