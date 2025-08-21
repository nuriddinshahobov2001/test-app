<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductType;
use App\Services\ProductService;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(readonly private ProductService $productService)
    {
    }

    public function index(): View
    {
        $products = $this->productService->getProducts();
        return view('product.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $brands = Brand::all();
        $currencies = Currency::all();
        $productTypes = ProductType::all();
        $products = Product::all();
        return view('product.create.create', compact(
            'categories',
            'brands',
            'currencies',
            'productTypes',
            'products'
        ));
    }

    public function store(StoreProductRequest $product)
    {
        $this->productService->store($product->safe());
        return redirect()->route('products.create')->with('success', 'Product created successfully.');
    }
}
