<?php

namespace App\Traits;

use Random\RandomException;

trait GenerateSKU
{

    public function generateSku(int $length = 16): string
    {
        do {
            $sku = substr(str_shuffle(str_repeat('0123456789', $length)), 0, $length);

        } while (\App\Models\Product::query()->where('sku', '=', $sku)->exists());

        return $sku;
    }

}
