<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Cache::rememberForever('categories', function () {
            return Category::latest()->get();
        });
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        Helpers::cache_categories();
        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,

        ]);
        $category = Category::findOrfail($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        Helpers::cache_categories();

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        Helpers::cache_categories();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
