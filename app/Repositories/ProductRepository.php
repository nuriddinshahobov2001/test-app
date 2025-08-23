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

    public function getProductById($id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|Product|null
    {
        return Product::query()->findOrFail($id);
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

    public function deleteProduct(string $id): void
    {
        Product::query()->find($id)->delete();
    }

    public function update(array $data, string $id): ?Product
    {
        $updated = Product::query()->where('id', $id)->update([
            'name' => $data['name'],
            'product_type_id' => $data['product_type_id'],
            'brand_id' => $data['brand_id'],
            'category_id' => $data['category_id'],
            'currency_id' => $data['currency_id'],
            'sku' => $data['sku'],
        ]);

        if ($updated) {
            return $this->getProductById($id);
        }

        return null;
    }


    public function updateLocation(array $locations, string $productId, array $locationNames): void
    {
        ProductLocation::query()->upsert(
            $locations,
            ['product_id', 'location_name'],
            ['selling_price', 'purchase_price', 'stock', 'updated_at']
        );
        ProductLocation::query()->where('product_id', $productId)
            ->whereNotIn('location_name', $locationNames)
            ->delete();
    }

    public function updateVariations(array $variations, string $productId, array $variationNames): void
    {
        ProductVariation::query()->upsert(
            $variations,
            ['product_id', 'name'],
            ['options']
        );
        ProductVariation::query()->where('product_id', $productId)
            ->whereNotIn('name', $variationNames)
            ->delete();
    }

    public function deleteLocation(string $id): void
    {
        ProductLocation::query()->where('product_id', $id)->delete();
    }

}
