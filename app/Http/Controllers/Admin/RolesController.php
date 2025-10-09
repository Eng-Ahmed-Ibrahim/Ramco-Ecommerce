<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yoeunes\Toastr\Facades\Toastr;
use Flasher\Laravel\Facade\Flasher;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{

    public function index(Request $request)
    {

        $permissions = Permission::orderBy("id", "DESC")
            ->orderBy('section')
            ->get()->groupBy('section');
        $roles = Role::orderBy("id", "DESC")->get();
        return view('admin.roles.index')
            ->with('permissions', $permissions)
            ->with('roles', $roles)
        ;
    }
    public function store(Request $request)
    {
        // هتتفعل فقط لو نجحت الفاليديشن

        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);
        if (Role::where("name", $request->name)->first()) {
            session()->flash("error","موجود بالفعل صلاحيه بهذا الاسم");
            return back();
        }
        $role = Role::create([
            "name" => $request->name,
        ]);
        $permissions = $request->permissions;
        $role->syncPermissions($permissions);
        return back()->with("success",'Added Successfully');
    }
    public function edit($id)
    {
        $role = Role::find($id);
        $users = Admin::role($role->name)->get();

        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::orderBy("id", "DESC")->orderBy('section')->get()->groupBy('section');

        return view('admin.roles.edit', compact('role', 'users', 'permissions', 'rolePermissions'));
    }
    public function update(Request $request)
    {
        $role = Role::findOrFail($request->id);
   
        $role->update([
            "name" => $request->name,
        ]);
        $permissions = $request->permissions;


        $role->syncPermissions($permissions);
        return back()->with("success",'Updated Successfully');
    }
        public function destroy($id)
    {
        $role = Role::withCount('users')->findOrFail($id);

        if($role->users_count > 0) {
            return back()->with("error","Can't delete this roles , assigned to users");
        }
        $role->delete();
        return back()->with("success","Deleted Successfully");
    }
}
