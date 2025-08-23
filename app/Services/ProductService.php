<?php

namespace App\Services;

use App\Handlers\ImageHandler;
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

    public function delete(string $id): void
    {
        $product = $this->repository->getProductById($id);
        if (!empty($product)) {
            foreach ($product->photos as $photo) {
                (new ImageHandler)->deleteImage($photo->path);
            }
            $this->repository->deleteProduct($id);
        }
    }

    public function update(array $safe, $id)
    {
        $product = $this->repository->getProductById($id);
        $safe['sku'] = $product->sku ?? $this->generateSku();
        $updatedProduct = $this->repository->update($safe, $product->id);
        if (empty($safe['locations'])) {
            $this->deleteVariations($updatedProduct, $this->repository);
        } else {
            $this->updateLocations($updatedProduct, $safe['locations'], $this->repository);
        }
        $productType = (int)$safe['product_type_id'];
        if ($productType === 2) {
            $this->updateVariation($product, $safe['options'], $this->repository);
        }
//        DB::transaction(function () use ($safe, $id) {
//        });
    }


}
