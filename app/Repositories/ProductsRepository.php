<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductsRepository
{

    public function getProducts($filters)
    {
        $products = Product::filter($filters)
            ->select('id', 'name', 'slug', 'price', 'colors', 'thumbnail', 'category_id', 'sub_category_id','is_best_seller','is_best_product')
            ->with(['category:id,name,slug', 'subCategory'])->paginate(16);
        return $products;
    }
    public function show($slug)
    {
        $product = Product::with('galleries')->where('slug', $slug)->with('category:id,name')->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->select('id', 'name', 'thumbnail', 'price')
            ->take(3)
            ->get();


        $gallery = $product->galleries;
        $minCount = 5;
        $currentCount = $gallery->count();

        if ($currentCount < $minCount) {
            $placeholdersNeeded = $minCount - $currentCount;

            // حول إلى Collection لو مش Collection
            $gallery = collect($gallery);

            // احسب خطوات الإدخال بشكل موزع
            for ($i = 0; $i < $placeholdersNeeded; $i++) {
                // نحاول ندخل الصورة في أماكن متفرقة لتجنب التكرار
                $insertPosition = ($i * 2) % ($gallery->count() + 1);
                // @phpstan-ignore-next-line
                $gallery->splice($insertPosition, 0, [
                    (object)['image' => $product->thumbnail]
                ]);
            }
        }
        // @phpstan-ignore-next-line
        $product->galleries = $gallery;



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
