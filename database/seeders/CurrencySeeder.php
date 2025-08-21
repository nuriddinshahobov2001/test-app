<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'Сомони', 'code_iso' => 'TJS'],
            ['name' => 'Рубль', 'code_iso' => 'RUB'],
            ['name' => 'Доллар', 'code_iso' => 'USD'],
            ['name' => 'Евро', 'code_iso' => 'EUR'],
        ];
        Currency::query()->insert($currencies);
    }
}
