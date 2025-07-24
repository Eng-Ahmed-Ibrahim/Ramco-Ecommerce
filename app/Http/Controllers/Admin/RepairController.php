<?php

namespace App\Http\Controllers\Admin;

use App\Models\Repair;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepairController extends Controller
{
    public function index(){
        $repairs=Repair::orderBy("id","DESC")->paginate(15);
        return view('admin.repair.index',compact('repairs'));
    }
    public function show($id){
        $repair=Repair::findOrFail($id);
        return view('admin.repair.show',compact('repair'));
    }
    public function destroy($id){
               $repair=Repair::findOrFail($id);
        $repair->delete();
        return back()->with("success","Deleted Successfully");
    }
}
