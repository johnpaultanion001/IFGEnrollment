<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = Permission::all();

        

        $admin_permissions = $permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_';
        });

        $sales_permissions = $permissions->filter(function ($permission) {
            return substr($permission->title, 0, 6) != 'admin_' && substr($permission->title, 0, 8) != 'billing_' && substr($permission->title, 0, 11) != 'accounting_' && substr($permission->title, 0, 5) != 'user_';
        });

        $billing_permissions = $permissions->filter(function ($permission) {
            return substr($permission->title, 0, 6) != 'admin_' && substr($permission->title, 0, 6) != 'sales_' && substr($permission->title, 0, 11) != 'accounting_' && substr($permission->title, 0, 5) != 'user_';
        });
        $accounting_permissions = $permissions->filter(function ($permission) {
            return substr($permission->title, 0, 6) != 'admin_' && substr($permission->title, 0, 6) != 'sales_' && substr($permission->title, 0, 8) != 'billing_' && substr($permission->title, 0, 5) != 'user_';
        });

        $user_permissions = $permissions->filter(function ($permission) {
            return substr($permission->title, 0, 6) != 'admin_' && substr($permission->title, 0, 6) != 'sales_' && substr($permission->title, 0, 8) != 'billing_' && substr($permission->title, 0, 11) != 'accounting_';
        });

        Role::findOrFail(1)->permissions()->sync($admin_permissions);
        Role::findOrFail(2)->permissions()->sync($sales_permissions);
        Role::findOrFail(3)->permissions()->sync($billing_permissions);
        Role::findOrFail(4)->permissions()->sync($accounting_permissions);
        Role::findOrFail(5)->permissions()->sync($user_permissions);
    }
}
