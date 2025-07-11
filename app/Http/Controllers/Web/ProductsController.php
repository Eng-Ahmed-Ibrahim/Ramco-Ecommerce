<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Services\SubcategoriesService;

class ProductsController extends Controller
{
    private $ProductService;
    private $CategoryService;
    private $SubcategoriesService;
    function __construct(ProductService $ProductService,CategoryService $CategoryService,
        SubcategoriesService $SubcategoriesService,
        )
    {
        $this->ProductService=$ProductService;
        $this->CategoryService=$CategoryService;
        $this->SubcategoriesService=$SubcategoriesService;
    }
    public function index($category_slug,Request $request)  {
        $category_id = $this->CategoryService->get_category_id($category_slug);
        $filters=[
            "category_id"=>$category_id,
        ];
        $products=$this->ProductService->getProducts($filters);
        $sub_categories=$this->SubcategoriesService->get_sub_categories($category_id);
        return view('web.products.index',compact('products','sub_categories'));
    }
    public function show($category_slug,$product_slug)  {
        $result=$this->ProductService->findProduct($product_slug);
        $product=$result['product'];
        $relatedProducts=$result['relatedProducts'];
        return view('web.products.show',compact('product','relatedProducts'));
        
    }
}
