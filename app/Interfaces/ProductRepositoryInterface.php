<?php

namespace App\Interfaces;


interface ProductRepositoryInterface
{
    public function getProducts();

    public function getProductById($id);

    public function createProductSimple(array $product);

    public function createProductVariation(array $product);

    public function createProductCombo(array $product);

    public function createLocation(array $location);

    public function createImage(array $images);

    public function deleteProduct(string $id);

    public function update(array $data, string $id);

    public function updateLocation(array $locations, string $productId, array $locationNames);

    public function updateCombos(array $combos, string $productId, array $combosId);
    public function deleteLocation(string $id);

    public function deleteVariations(string $productId);

    public function deleteCombos(string $productId);

    public function updateVariations(array $variations, string $productId, array $variationNames);
}
