<?php

namespace App\Services\API;

use App\Interfaces\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        readonly private ProductRepositoryInterface $productRepository,
    )
    {
    }

    function calculateTotalStock() {
        return $this->productRepository->calculateTotalStock();
    }

    public function calculateTotalPurchase()
    {
        return $this->productRepository->calculateTotalPurchase();
    }

    public function calculateTotalSelling()
    {
        return $this->productRepository->calculateTotalSelling();
    }

    public function products()
    {
        return $this->productRepository->getProductsApi();
    }
}
