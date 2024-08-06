<?php

namespace App\Rules;

use App\Models\ReferralCode;
use Illuminate\Contracts\Validation\Rule;

class ValidReferralCode implements Rule
{
    public function __construct()
    {
        //
    }

    
    public function passes($attribute, $value)
    {
        return ReferralCode::where('referral_code', $value)->where('isUsed',false)->exists();
    }

   
    public function message()
    {
        return 'The :attribute is not a valid or already used , Contact the administrator to verify this referral code.';
    }
}
