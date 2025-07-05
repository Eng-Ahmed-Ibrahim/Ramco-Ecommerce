<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductsRepository
{
    public function getProducts($filer)
    {
        $products = Product::filter($filer)
        ->select('id','name','slug','price','thumbnail','category_id')
        ->with(['category:id,name'])->paginate(16);
        return $products;
    }
    public function show($slug)
    {
        $product = Product::with('galleries')->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->select('id','name','thumbnail','price')
            ->take(3)
            ->get();

        return [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ];
    }
    public function store($data)
    {
        return Product::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'colors' => $data['colors'],
            'details' => $data['details'],
            'price' => $data['price'],
            'thumbnail' => $data['thumbnail'],
            'weight' => $data['weight'],
            'dimensions' => $data['dimensions'],
            'cooling_power' => $data['cooling_power'],
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'],
        ]);
    }
    public function update($id, $data)
    {
        $product = Product::findOrFail($id);
        if (isset($data['thumbnail']) && $data['thumbnail'] != null && Storage::disk('public')->exists($product->thumbnail)) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        $product->update([
            'name' => $data['name'] ?? $product->name,
            'slug' => isset($data['name']) ? Str::slug($data['name']) : $product->slug,
            'thumbnail' => $data['thumbnail'] ?? $product->thumbnail,
            'colors' => $data['colors'] ?? $product->colors,
            'details' => $data['details'] ?? $product->details,
            'price' => $data['price'] ?? $product->price,
            'weight' => $data['weight'] ?? $product->weight,
            'dimensions' => $data['dimensions'] ?? $product->dimensions,
            'cooling_power' => $data['cooling_power'] ?? $product->cooling_power,
            'category_id' => $data['category_id'] ?? $product->category_id,
            'sub_category_id' => $data['sub_category_id'] ?? $product->sub_category_id,
        ]);

        return $product;
    }
    public function destroy($id)
    {
        $product = Product::with('galleries')->findOrFail($id);
        if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        if (! empty($product->galleries) && $product->galleries->count() > 0) {
            foreach ($product->galleries as $gallery) {
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    Storage::disk('public')->delete($gallery->image);
                }
            }
        }
        $product->delete();

        return true;
    }
}
