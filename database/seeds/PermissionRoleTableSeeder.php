<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = Permission::all();

        $user_permissions = $permissions->filter(function ($permission) {
            return substr($permission->title, 0, 6) != 'admin_' && substr($permission->title, 0, 6) != 'staff_';
        });

        $admin_permissions = $permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_';
        });

        $staff_permissions = $permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 6) != 'admin_';
        });

        Role::findOrFail(1)->permissions()->sync($admin_permissions);
        Role::findOrFail(2)->permissions()->sync($staff_permissions);
        Role::findOrFail(3)->permissions()->sync($user_permissions);
    }
}
