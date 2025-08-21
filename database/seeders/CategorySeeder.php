<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Электроника'],
            ['name' => 'Одежда'],
            ['name' => 'Еда'],
            ['name' => 'Спорт'],
            ['name' => 'Овощи'],
            ['name' => 'Фрукты'],
            ['name' => 'Напитки'],
        ];
        Category::query()->insert($categories);
    }
}
