<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\ProductCombo;
use App\Models\ProductImage;
use App\Models\ProductLocation;
use App\Models\ProductVariation;

class ProductRepository implements ProductRepositoryInterface
{
    public function getProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return Product::query()->get();
    }

    public function getProductById($id)
    {
        // TODO: Implement getProductById() method.
    }

    public function createProductSimple(array $product)
    {
        return Product::query()->create($product);
    }

    public function createProductVariation(array $product): void
    {
        ProductVariation::query()->insert($product);
    }

    public function createProductCombo(array $product): void
    {
        ProductCombo::query()->insert($product);
    }

    public function createLocation(array $location): void
    {
        ProductLocation::query()->insert($location);
    }

    public function createImage(array $images): void
    {
        ProductImage::query()->insert($images);
    }
}
