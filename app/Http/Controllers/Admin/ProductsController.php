<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Helpers\Helpers;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ProductsController extends Controller
{
    private $ProductService;
    public function __construct(ProductService $ProductService)
    {
        $this->ProductService = $ProductService;
    }
    public function index(Request $request)
    {
        $filters = [];
        $products = $this->ProductService->getProducts($filters);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Helpers::get_categories();
        $subCategories = Helpers::get_sub_categories();
        return view('admin.products.create', compact('categories', 'subCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'colors' => 'required|string',
            'price' => 'required|numeric',
            'model' => 'required|string',
            'description' => 'required|string',
            'details' => 'required|string',
            'thumbnail' => 'required|image',
            'weight' => 'required|string',
            'dimensions' => 'required|string',
            'cooling_power' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'galleries.*' => 'nullable|image',
        ]);

        $validated['thumbnail'] = $request->file('thumbnail');

        $galleryFiles = $request->file('galleries', []);

        $product = $this->ProductService->add_product($validated, $galleryFiles);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }


    public function edit(Product $product)
    {

        $categories = Cache::get('categories');
        $subCategories = Cache::get('sub_categories_model');
        return view('admin.products.edit', compact('product', 'categories', 'subCategories'));
    }

    public function update(Request $request,  $id)
    {
        $validated = $request->validate([

            'name' => 'required|string|max:255',
            'colors' => 'required|string',
            'price' => 'required|numeric',
            'details' => 'required|string',
            'thumbnail' => 'nullable|image',
            'weight' => 'required|string',
            'dimensions' => 'required|string',
            'cooling_power' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'galleries.*' => 'nullable|image',
            'model' => 'required|string',
            'description' => 'required|string',
        ]);

        $data = $validated;
        $data['thumbnail'] = null;
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail');
        }

        $galleryFiles = $request->file('galleries', []);

        $product = $this->ProductService->update_product($data, $id, $galleryFiles);




        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $this->ProductService->delete_product($id);
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }


    public function sort(Request $request)
    {
        $startPosition = ($request->page - 1) * $request->perPage + 1;

        foreach ($request->order as $index => $item) {
            Product::where('id', $item['id'])->update(['position' => $startPosition + $index]);
        }

        return response()->json(['status' => 'success']);
    }

    public function toggleFlag(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'type' => 'required|in:is_best_seller,is_best_product',
            'value' => 'required|boolean',
        ]);

        $product = \App\Models\Product::findOrFail($request->id);
        $product->{$request->type} = $request->value;
        $product->save();
        if($request->type == "is_best_seller"){
            Helpers::cache_best_sellers();
        }elseif($request->type == "is_best_product"){
            Helpers::cache_best_products();
        }

        return response()->json(['status' => 'success']);
    }
    public function setHomeBanner(Request $request)
    {
        $productId = $request->id;

        Product::where('home_banner', true)->update(['home_banner' => false]);

        $product = Product::findOrFail($productId);
        $product->home_banner = true;
        $product->save();
        Helpers::cache_home_banner();

        return response()->json(['success' => true, 'message' => 'Home banner product updated']);
    }
}
