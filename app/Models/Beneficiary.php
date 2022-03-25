<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beneficiary extends Model
{
    use SoftDeletes , HasFactory;

    protected $fillable = [
        'user_id',
        'receipt_country',
        'payment_mode',
        //Payout Location
        'bank_name',
        'account_number',
        //Beneficiary Details
        'beneficiary_firstname',
        'beneficiary_middlename',
        'beneficiary_lastname',
        'mobile_number',
        //Address Details
        'address',
        'purpose_of_remit',
        'purpose_of_remit_others',
        'relation_with_beneficiary',
        'relation_with_beneficiary_others',
        'beneficiary_email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function country()
    {
        return $this->belongsTo(CountryExchange::class, 'receipt_country' , 'id');
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_name' , 'id');
    }
}
