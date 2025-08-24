<?php

namespace App\Traits;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Handlers\ImageHandler;
use App\Models\ProductImage;

trait ProductTrait
{

    public function createLocation(Product $product, array $locationsData, ProductRepositoryInterface $repository): void
    {
        $locations = array_map(fn($location) => [
            'product_id' => $product->id,
            'location_name' => $location['name'],
            'selling_price' => (float)$location['sale_price'],
            'purchase_price' => (float)$location['purchase_price'],
            'stock' => (int)$location['stock'],
            'created_at' => now(),
            'updated_at' => now()
        ], $locationsData);
        $repository->createLocation($locations);
    }

    public function createVariation(Product $product, array $productData, ProductRepositoryInterface $repository): void
    {
        $variations = array_map(fn($variation) => [
            'product_id' => $product->id,
            'name' => $variation['name'],
            'options' => json_encode(
                array_filter(
                    array_map('trim', explode(',', $variation['values']))
                )
            ),
            'created_at' => now(),
            'updated_at' => now()
        ], $productData);
        $repository->createProductVariation($variations);
    }

    public function createCombo(Product $product, array $productData, ProductRepositoryInterface $repository): void
    {
        $compos = array_map(fn($compo) => [
            'product_id' => $product->id,
            'combo_id' => $compo['product'],
            'quantity' => $compo['quantity'],
            'created_at' => now(),
            'updated_at' => now()
        ], $productData);
        $repository->createProductCombo($compos);
    }

    public function createImage(Product $product, array $imageData, ProductRepositoryInterface $repository): void
    {
        $images = (new ImageHandler)->processProductImages($product, $imageData);
        $result = array_map(function ($image) use ($product) {
            return [
                'product_id' => $product->id,
                'path' => $image['path'],
                'filename' => $image['filename'],
                'filesize' => $image['size'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }, $images);
        if (!empty($result)) {
            $repository->createImage($result);
        }
    }

    public function updateLocations(Product $product, array $locationsData, ProductRepositoryInterface $repository): void
    {
        $locations = [];
        $locationNames = [];
        foreach ($locationsData as $loc) {
            $locations[] = [
                'product_id' => $product->id,
                'location_name' => $loc['location_name'],
                'selling_price' => $loc['selling_price'] ?? 0,
                'purchase_price' => $loc['purchase_price'] ?? 0,
                'stock' => $loc['stock'] ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $locationNames[] = $loc['location_name'];
        }
        $repository->updateLocation($locations, $product->id, $locationNames);
    }

    public function updateVariation(Product $product, array $variationsData, ProductRepositoryInterface $repository): void
    {
        $variations = [];
        $variationNames = [];
        foreach ($variationsData as $variation) {
            $variations[] = [
                'product_id' => $product->id,
                'name' => $variation['name'],
                'options' => json_encode(
                    array_filter(
                        array_map('trim', explode(',', $variation['values']))
                    )
                ),
                'created_at' => now(),
                'updated_at' => now()
            ];
            $variationNames[] = $variation['name'];
        }
        $repository->updateVariations($variations, $product->id, $variationNames);
    }

    public function updateCombos(Product $product, array $combosData, ProductRepositoryInterface $repository): void
    {
        $combos = [];
        $combosId = [];
        foreach ($combosData as $combo) {
            $combos[] = [
                'product_id' => $product->id,
                'combo_id' => $combo['product'],
                'quantity' => $combo['quantity'],
                'created_at' => now(),
                'updated_at' => now()
            ];
            $combosId[] = $combo['product'];
        }
        $repository->updateCombos($combos, $product->id, $combosId);
    }

    public function deleteLocations(Product $product, ProductRepositoryInterface $repository): void
    {
        $repository->deleteLocation($product->id);
    }

    public function deleteVariations(Product $product, ProductRepositoryInterface $repository): void
    {
        $repository->deleteVariations($product->id);
    }

    public function deleteCombos(Product $product, ProductRepositoryInterface $repository): void
    {
        $repository->deleteCombos($product->id);
    }

    public function deletePhotos(array $photoData, ProductRepositoryInterface $repository): void
    {
        $imageHandler = new ImageHandler();
        foreach ($photoData as $photo) {
            $imageHandler->deleteImage($photo['path']);
            $repository->deletePhoto($photo['id']);
        }
    }
}
