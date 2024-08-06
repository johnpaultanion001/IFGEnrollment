<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'title' => 'Admin',
            ],
            [
                'title' => 'Sales',
            ],
            [
                'title' => 'Billing',
            ],
            [
                'title' => 'Accounting',
            ],
            [
                'title' => 'User',
            ],
        ];

        Role::insert($roles);
    }
}
