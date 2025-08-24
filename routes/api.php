<?php

use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/products-count',[ProductController::class, 'count']);
Route::get('/products',[ProductController::class, 'products']);
