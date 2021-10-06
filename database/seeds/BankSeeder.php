<?php

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Manila');
        $banks = [
            [
                'id'    => 1,
                'bank_name' => 'Bank of the Philippine Islands',
                'province_code' => '0458',
                'city_municipality_code' => '045802',
                'address' => 'Ground Floor Victory Park & Shop ML Quezon and, P. Oliveros Street, Antipolo, 1870 Rizal',
            ],
           
        ];

        Bank::insert($banks);
    }
}
