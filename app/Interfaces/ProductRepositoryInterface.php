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
}
