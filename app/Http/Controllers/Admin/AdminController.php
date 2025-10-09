<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public $model_view_folder;
    public function __construct()
    {
        $this->model_view_folder = 'admin.admins.';
    }
    public function index()
    {
        $admins = Admin::orderBy("id", "DESC")->where('id',Auth::guard('admin')->user()->id)->paginate(15);
        $roles=Role::get();
        return view($this->model_view_folder . "index")
            ->with("admins", $admins)
            ->with("roles", $roles)
            ;
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required|exists:roles,name',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('form_type', 'add');
        }
        $admin = Admin::create([
            "email" => $request->email,
            "name" => $request->name,
            "password" => Hash::make($request->password),
        ]);
        $admin->assignRole($request->role);

        if ($request->file('avatar')) {
            $admin->update([
                "avatar" => $request->file('avatar')->store('avatar','public')
            ]);
        }
        return back()->with("success", "Added Successfully");
    }
    public function delete($admin_id)
    {
        $admin = Admin::find($admin_id);
        if ($admin->avatar && Storage::disk('public')->exists($admin->avatar)) {
            Storage::disk('public')->delete($admin->avatar);
        }
        $admin->delete();
        return back()->with('success', "Deleted Successfully");
    }
    public function update(Request $request)
    {
        $admin = Admin::findOrFail($request->admin_id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required|exists:roles,name',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('form_type', 'edit')
            ->with('edit_id', $admin->id);
        }
        

        if ($request->hasFile("avatar")) {
            if ($admin->avatar && Storage::disk('public')->exists($admin->avatar)) {
                Storage::disk('public')->delete($admin->avatar);
            }
            $admin->update([
                "avatar" => $request->file('avatar')->store('avatar','public')
            ]);
        }
        if ($request->filled("password")) {
            $admin->update([
                "password" => Hash::make($request->password),
            ]);
        }

        $admin->update([
            "name" => $request->name,
            "email" => $request->email,
            "role" => $request->role,
        ]);
                $admin->syncRoles($request->role);


        return back()->with('success','updated successfully');
    }


}
