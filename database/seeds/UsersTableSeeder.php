<?php

use App\Models\ReferralCode;
use App\Models\User;

use Illuminate\Database\Seeder;



class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'email'          => 'admin@admin.com',
                'referral_code' => '1001',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'firstname'      => 'John paul Admin',
                'middlename'      => 'V',
                'lastname'      => 'Admin',

                'isRegistered' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
            ],
            [
                'email'          => 'sales@sales.com',
                'referral_code' => '1002',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'firstname'      => 'John paul Sales',
                'middlename'      => 'V',
                'lastname'      => 'Test',

                'isRegistered' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
            ],
            [
                'email'          => 'billing@billing.com',
                'referral_code' => '1003',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'firstname'      => 'John paul Billing',
                'middlename'      => 'V',
                'lastname'      => 'Test',

                'isRegistered' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
            ],
            [
                'email'          => 'accounting@accounting.com',
                'referral_code' => '1004',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'firstname'      => 'John paul Accounting',
                'middlename'      => 'V',
                'lastname'      => 'Test',

                'isRegistered' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
            ],
            [
                'email'          => 'user@user.com',
                'referral_code' => '1005',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'firstname'      => 'Test1',
                'middlename'      => 'V',
                'lastname'      => 'User',

                'isRegistered' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
            ],
            [
                'email'          => 'johnpaultanion001@gmail.com',
                'referral_code' => '1006',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'firstname'      => 'John Paul',
                'middlename'      => 'V',
                'lastname'      => 'Tanion',

                'isRegistered' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
            ],
        ];



        $referrals = [
            [
                'referral_code' => 'IFG01',
                'remarks' => 'For test',

                'created_at'            => date("Y-m-d H:i:s"),
                'updated_at'            => date("Y-m-d H:i:s"),

            ],
        ];



        User::insert($users);
    
        ReferralCode::insert($referrals);
    }
}
