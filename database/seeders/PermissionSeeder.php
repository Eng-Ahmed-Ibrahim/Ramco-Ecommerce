<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            "home page" => [
                "view home page",

                "view home banners",
                "create banner",
                "edit banner",
                "delete banner",
                "view sections",
                "edit sections",
                "view need help",
                "create item of need help",
                "edit item of need help",
                "delete item of need help",
            ],
            "about page" => [
                "view background",
                "edit background",
                "view sections",
                "edit sections",
            ],
            "rapairs" => [
                "view",
                "show",
                "delete",
            ],
            "messages" => [
                "view",
                "show",
                "delete"
            ],
            "use guides" => [
                "view",
                "create",
                "edit",
                "delete"
            ],
            "orders" => [
                "view",
                "show",
                "delete",
                "change status"
            ],
            "products" => [
                "show",
                "create",
                "edit",
                "delete",
                "change status of home banners",
                "change status of best seller",
                "change status of best product",
                "change status of usd",
            ],
            "admins" => [
                "view",
                "create",
                "edit",
                "delete"
            ],
            "roles" => [
                "view",
                "create",
                "edit",
                "delete"
            ],
            "categories" => [
                "view",
                "edit",
            ],
            "sub categories" => [
                "view",
                "create",
                "edit",
                "delete"
            ],
            "coupins" => [
                "view",
                "create",
                "edit",
                "delete"
            ],
            "dashboard" => [
                "view"
            ],
        ];
        foreach ($permissions as $section => $sub_permissions) {
            foreach ($sub_permissions as $permission) {
                $permissionName = "{$section}-{$permission}";

                Permission::firstOrCreate([
                    "name" => $permissionName,
                    "section" => $section,
                    "guard_name" => "admin"
                ]);
            }
        }
        // $superAdmin = Role::firstOrCreate([
        //     'name' => 'super admin',
        //     'guard_name' => 'admin'
        // ]);

        // $allPermissions = Permission::where('guard_name', 'admin')->get();
        // $superAdmin->syncPermissions($allPermissions);

        // $admin = Admin::find(1);
        // $admin->update([
        //     "role" => "super admin",
        // ]);
        // $admin->assignRole('super admin');
    }
}
