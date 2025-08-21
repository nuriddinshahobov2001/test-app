<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Простой продукт'],
            ['name' => 'Продукт с вариациями'],
            ['name' => 'Комбо продукт'],
        ];
        ProductType::query()->insert($types);
    }
}
