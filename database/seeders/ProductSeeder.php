<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Картошка', 'product_type_id' => 1, 'brand_id' => 1, 'category_id' => 1, 'currency_id' => 1, 'sku' => ''],
            ['name' => 'Помидоры', 'product_type_id' => 1, 'brand_id' => 3, 'category_id' => 7, 'currency_id' => 1, 'sku' => ''],
            ['name' => 'Ручка', 'product_type_id' => 1, 'brand_id' => 7, 'category_id' => 4, 'currency_id' => 1, 'sku' => ''],
            ['name' => 'Книга', 'product_type_id' => 1, 'brand_id' => 5, 'category_id' => 6, 'currency_id' => 1, 'sku' => ''],
        ];
        Product::query()->insert($products);
    }
}
