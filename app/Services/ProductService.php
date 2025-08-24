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
        DB::transaction(function () use ($safe, $id) {
            $product = $this->repository->getProductById($id);
            $safe['sku'] = $product->sku ?? $this->generateSku();
            $updatedProduct = $this->repository->update($safe, $product->id);
            if (empty($safe['locations'])) {
                $this->deleteLocations($updatedProduct, $this->repository);
            } else {
                $this->updateLocations($updatedProduct, $safe['locations'], $this->repository);
            }
            if (!empty($safe['photos'])) {
                $this->createImage($product, $safe['photos'], $this->repository);
            }
            if ($safe['photos_to_delete']) {
                $photos = $this->repository->getPhotos($updatedProduct->id, $safe['photos_to_delete']);
                $this->deletePhotos($photos->toArray(), $this->repository);
            }
            $productType = (int)$safe['product_type_id'];
            if ($productType === 1) {
                $this->deleteCombos($updatedProduct, $this->repository);
                $this->deleteVariations($updatedProduct, $this->repository);
            }
            if ($productType === 2) {
                $this->deleteCombos($updatedProduct, $this->repository);
                $this->updateVariation($product, $safe['options'], $this->repository);
            }
            if ($productType === 3) {
                $this->deleteVariations($updatedProduct, $this->repository);
                $this->updateCombos($updatedProduct, $safe['components'], $this->repository);
            }
        });
    }


}
