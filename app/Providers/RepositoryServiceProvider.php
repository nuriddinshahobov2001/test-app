<?php

namespace App\Providers;


use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProductRepositoryInterface::class => ProductRepository::class,
    ];
}
