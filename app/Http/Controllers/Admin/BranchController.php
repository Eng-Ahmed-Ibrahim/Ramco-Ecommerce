<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Helpers::get_branches();
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'office_email' => 'nullable|email',
            'factory_email' => 'nullable|email',
        ]);

        Branch::create($request->all());
        Helpers::cache_branches();
        return redirect()->route('admin.branches.index')->with('success', 'Branch created successfully');
    }

    public function show(Branch $branch)
    {
        return view('admin.branches.show', compact('branch'));
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request,  $id)
    {
        $branch = Branch::findOrFail($id);

        $branch->update($request->all());
        Helpers::cache_branches();

        return redirect()->route('admin.branches.index')->with('success', 'Branch updated');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);

        $branch->delete();
        Helpers::cache_branches();

        return redirect()->route('admin.branches.index')->with('success', 'Branch deleted');
    }
}
