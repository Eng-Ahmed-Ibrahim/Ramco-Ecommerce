<?php

namespace App\Http\Controllers\Web;

use App\Models\Repair;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepairController extends Controller
{
    public function index() {
        $products=Product::select('id','sub_category_id','thumbnail','name')->with("subCategory:name,id")->get();
        return view('web.repair.index',compact('products') ) ;
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'          => 'required|string|max:255',
            'phone'              => 'required|string|max:20',
            'email'              => 'required|email|max:255',
            'address'            => 'required|string|max:255',
            'product_name'       => 'required|string|max:255',
            'serial_number'      => 'required|string|max:255',
            'purchase_date'      => 'required|date',
            'guarantee_date'     => 'required|date',
            'branch'             => 'required|string|max:255',
            'issue'              => 'required|string|max:255',
            'description'        => 'required|string',
            'visit_request_date' => 'required|date|after_or_equal:today',
            'time'               => 'required|string|max:20',
        ]);
        Repair::create($validated);
        return redirect()->back()->with('success', 'Repair request submitted successfully!');
    }
}
