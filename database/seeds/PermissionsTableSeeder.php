<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'title' => 'admin_access',
            ],
            [
                'title' => 'sales_access',
            ],
            [
                'title' => 'billing_access',
            ],
            [
                'title' => 'accounting_access',
            ],
            [
                'title' => 'user_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
