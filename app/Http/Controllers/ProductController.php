<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductType;
use App\Services\ProductService;
use Illuminate\Http\Request;
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

    public function show(Product $product)
    {

        return view('product.show.index', compact('product'));
    }

    public function edit(Product $product): view
    {
        $categories = Category::all();
        $brands = Brand::all();
        $currencies = Currency::all();
        $productTypes = ProductType::all();
        $products = Product::all();
        return view('product.edit.edit', compact(
            'product',
            'categories',
            'brands',
            'currencies',
            'productTypes',
            'products'
        ));
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $this->productService->update($request->safe(), $id);
        return redirect()->route('products.edit', $id)->with('success', 'Product updated successfully.');

    }

    public function destroy(string $id)
    {
        $this->productService->delete($id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
