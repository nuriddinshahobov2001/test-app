<?php

namespace App\Services;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Traits\GenerateSKU;
use App\Traits\ProductTrait;
use Illuminate\Support\Facades\DB;

class ProductService
{
    use GenerateSKU, ProductTrait;

    public function __construct(readonly private ProductRepositoryInterface $repository)
    {
    }

    public function getProducts()
    {
        return $this->repository->getProducts();
    }

    public function store(array $productData): void
    {
        DB::transaction(function () use ($productData) {
            $productType = (int)$productData['product_type_id'];
            $productData['sku'] = $this->generateSku();
            $product = $this->repository->createProductSimple($productData);
            if (!empty($productData['locations'])) {
                $this->createLocation($product, $productData['locations'], $this->repository);
            }
            if (!empty($productData['photos'])) {
                $this->createImage($product, $productData['photos'], $this->repository);
            }
            if ($productType === 2) {
                $this->createVariation($product, $productData['options'], $this->repository);
            }
            if ($productType === 3) {
                $this->createCombo($product, $productData['components'], $this->repository);
            }
        });
    }


}
