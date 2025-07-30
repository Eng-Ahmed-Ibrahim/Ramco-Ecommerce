<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Services\SubcategoriesService;

class ProductsController extends Controller
{
    private $ProductService;
    private $CategoryService;
    function __construct(ProductService $ProductService, CategoryService $CategoryService,)
    {
        $this->ProductService = $ProductService;
        $this->CategoryService = $CategoryService;
    }
    public function index($category_slug, Request $request)
    {
        $category = $this->CategoryService->get_category($category_slug);
        $category_id = $category->id;
        $filters = [
            "category_id" => $category->id,
            'no_category_and_subcategory_relationship'=>true,
        ];
        if($request->has('sub_category_id')) {
            $filters['sub_category_id'] = $request->sub_category_id;
        }
        $products = $this->ProductService->getProducts($filters);
        $sub_categories = $category->SubCategory;

        return view('web.products.index', compact('products', 'sub_categories', 'category_id','category'));
    }
    public function show($category_slug, $product_slug)
    {
        $result = $this->ProductService->findProduct($product_slug);
        $product = $result['product'];
        $relatedProducts = $result['relatedProducts'];
        $features = $product->features;
        return view('web.products.show', compact('product', 'relatedProducts','features'));
    }
    public function fetchBySubcategory(Request $request)
{
    if ($request->id == 'all') {
        $products = Helpers::get_best_sellers();
    } else {
        $products = $this->ProductService->getProducts([
            'sub_category_id' => $request->id,
            'is_best_seller'=>true,
            'no_paginate' => true,
        ]);
        
    }

    $html = view('web.partials.best_sellers', compact('products'))->render();

    return response()->json(['html' => $html]);
}

}
