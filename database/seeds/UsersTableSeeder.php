<?php

use App\Models\User;
use App\Models\CountryExchange;
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $users = [
            [
                'id'             => 1,
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'firstname'      => 'JohnpaulAdmin',
                'middlename'      => 'Valdez',
                'lastname'      => 'TanionAdmin',
                'date_of_birth' => '2000-02-21',
                'occupation' => 'test',
                'id_type' => 'test',
                'id_number' => '11111',
                'id_issued_country' => 'test',
                'id_issue_date' => '2020-02-21',
                'id_expiry_date' => '2025-02-02',
                'gender' => 'Male',
                'source_of_fund' => 'test1',
                'id_card_front' => 'test1',
                'id_card_back' => 'test1',
                'nationality' => 'test1',
                'country' => 'test1',
                'address' => 'test1',
                'mobile_number' => '11111',
                'telephone' => '11111',
                'terms_and_conditions' => 1,
                'isRegistered' => 1,
                'email_verified_at' => '2021-09-27 19:00:22',
                'created_at' => '2021-09-27 18:59:31',
                'updated_at' => '2021-09-27 19:07:34',
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'email'          => 'johnpaultanion@gmail.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'firstname'      => 'Johnpaul',
                'middlename'      => 'Valdez',
                'lastname'      => 'Tanion',
                'date_of_birth' => '2000-02-21',
                'occupation' => 'test',
                'id_type' => 'test',
                'id_number' => '11111',
                'id_issued_country' => 'test',
                'id_issue_date' => '2020-02-21',
                'id_expiry_date' => '2025-02-02',
                'gender' => 'Male',
                'source_of_fund' => 'test1',
                'id_card_front' => 'test1',
                'id_card_back' => 'test1',
                'nationality' => 'test1',
                'country' => 'test1',
                'address' => 'test1',
                'mobile_number' => '11111',
                'telephone' => '11111',
                'terms_and_conditions' => 1,
                'isRegistered' => 1,
                'email_verified_at' => '2021-09-27 19:00:22',
                'created_at' => '2021-09-27 18:59:31',
                'updated_at' => '2021-09-27 19:07:34',
                'remember_token' => null,
            ],
            
        ];
        $ce = [
            [
                'id'             => 1,
                'country'             => 'Philippines',
                'code'             => 'PHP',
                'exchange'             => 0.46,
                'created_at' => '2021-09-27 18:59:31',
                'created_at' => '2021-09-27 18:59:31',
                'updated_at' => '2021-09-27 19:07:34',
                
            ],
            
            
        ];
        User::insert($users);
        CountryExchange::insert($ce);

        // foreach(range(1,10) as $id)
        // {
        //     User::create([
        //         'name' => $faker->unique()->name,
        //         'email' => "user$id@user$id.com",
        //         'password' => bcrypt('password'),
        //     ]);
        // }
    }
}
