<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Models\UseGuide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UseGuideController extends Controller
{
    public function index()
    {
        $useGuides = UseGuide::orderBy("id", "DESC")->select('id', 'title', 'thumbnail')->paginate(15);
        return view('admin.use_guide.index', compact('useGuides'));
    }
    public function create()
    {
        return view('admin.use_guide.create');
    }
    public function edit($id)
    {
        $useGuide = UseGuide::findOrFail($id);

        return view('admin.use_guide.edit', compact('useGuide'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'required|image',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('products/thumbnail', 'public');

        UseGuide::create([
            'title'   => $request->title,
            'content' => Helpers::sanitizeContent($request->content),
            "thumbnail" => $thumbnailPath,
        ]);
        Helpers::cache_use_guides();
        return redirect()->back()->with('success', ' created successfully!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image',
        ]);
        $useGuide = UseGuide::findOrFail($id);

        if (isset($request->thumbnail) && $request->thumbnail != null && Storage::disk('public')->exists($useGuide->thumbnail)) {
            Storage::disk('public')->delete($useGuide->thumbnail);
            $useGuide->thumbnail = $request->file('thumbnail')->store('use_guides', 'public');
        }

        $useGuide->title = $request->title;

        $useGuide->content = Helpers::sanitizeContent($request->content);
        $useGuide->save();
        Helpers::cache_use_guides();

        return redirect()->back()->with('success', ' updated successfully!');
    }
    public function destroy($id)
    {
        $useGuide = UseGuide::findOrFail($id);
        if ( $useGuide != null && Storage::disk('public')->exists($useGuide->thumbnail)) {
            Storage::disk('public')->delete($useGuide->thumbnail);
        }
        $useGuide->delete();
        Helpers::cache_use_guides();

        return redirect()->back()->with('success', ' deleted successfully!');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('use_guides', 'public');
            return response()->json(['location' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
