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
                'name'                      => 'Bank of the Philippine Islands',
                'display_name'              => 'BPI ANTIPOLO',
                'province_code'             => '0458',
                'city_municipality_code'    => '045802',
                'address'                   => 'Ground Floor Victory Park & Shop ML Quezon and, P. Oliveros Street, Antipolo, 1870 Rizal',
                'status'                    => 'BANK',
                'lat'                       => 14.587449381156755,
                'lng'                       => 121.175578287383,
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'name'                      => 'BDO',
                'display_name'              => 'BDO ANTIPOLO',
                'province_code'             => '0458',
                'city_municipality_code'    => '045802',
                'status'                    => 'BANK',
                'address'                   => 'UGF 122, 123 & 124, SM Cherry Foodarama Antipolo, Marcos Highway Brgy, Antipolo, Metro Manila',
                'lat'                       => 14.6269153797475,
                'lng'                       => 121.13294912674506,
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'name'                      => 'METROBANK',
                'display_name'              => 'METROBANK ANTIPOLO',
                'province_code'             => '0458',
                'city_municipality_code'    => '045802',
                'status'                    => 'BANK',
                'address'                   => 'Kingsville Arcade, Marikina-Infanta Hwy, Antipolo, 1870',
                'lat'                       => 14.625012403103643,
                'lng'                       => 121.12318999694497,
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'name'                      => 'M LHUILLIER',
                'display_name'              => 'M LHUILLIER QC',
                'province_code'             => '1374',
                'city_municipality_code'    => '137404',
                'status'                    => 'CASH_AGENT',
                'address'                   => 'University of the Philippines Diliman, Diliman, Quezon City, Metro Manila',
                'lat'                       => 14.665806962937404,
                'lng'                       => 121.0525299413592,
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'name'                      => 'PALAWAN PAWNSHOP',
                'display_name'              => 'PALAWAN PAWNSHOP MANILA',
                'province_code'             => '1374',
                'city_municipality_code'    => '137404',
                'status'                    => 'CASH_AGENT',
                'address'                   => '136 Kalayaan Ave, Diliman, Quezon City, Metro Manila',
                'lat'                       => 14.6474704361429,
                'lng'                       => 121.05288751509542,
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'name'                      => 'CEBUANA LHUILLIER',
                'display_name'              => 'CEBUANA LHUILLIER ANTIPOLO',
                'province_code'             => '0458',
                'city_municipality_code'    => '045802',
                'status'                    => 'CASH_AGENT',
                'address'                   => 'Blk2 Lot14 Sumulong Hwy, Antipolo, 1870 Rizal',
                'lat'                       => 14.618426412627217,
                'lng'                       => 121.13755897203838,
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],

            

           
        ];

        Bank::insert($banks);
    }
}
