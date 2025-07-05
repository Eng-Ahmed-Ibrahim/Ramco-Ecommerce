<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SubCategoriesController extends Controller
{
     public function index(Request $request)
    {
        Cache::forget('sub_categories');

        $categories = Cache::rememberForever("categories",function(){
            return Category::latest()->get();
        }); 

        $sub_categories = SubCategory::filter($request->only(['category_id', 'name']))
            ->latest()
            ->paginate(15);

        return view('admin.sub_categories.index', compact('sub_categories','categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sub_categories,name',
            "category_id"=>"required|exists:categories,id",
        ]);

        SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->name),
        ]);
        Helpers::cache_sub_categories();

        return redirect()->back()->with('success', 'Sub Category added successfully.');
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sub_categories,name,' . $id,
            
        ]);
        $sub_category=SubCategory::findOrfail($id);
        $sub_category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        Helpers::cache_sub_categories();

        return redirect()->back()->with('success', 'Sub Category updated successfully.');
    }

    public function destroy(SubCategory $sub_category)
    {
        $sub_category->delete();
                Helpers::cache_sub_categories();

        return redirect()->back()->with('success', 'Sub Category deleted successfully.');
    }
}
