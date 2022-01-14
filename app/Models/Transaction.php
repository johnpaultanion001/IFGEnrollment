<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes , HasFactory;

    protected $fillable = [
        'user_id',
        'country_exchange_id',
        'beneficiary_id',
        'send_amount',
        'receive_amount',
        'service_charge',
        'total',
        'reference_number',
        'status',
        'transaction_payment_mode',
        'transaction_source_of_fund',
        'transaction_purpose_of_remit',
        'isConfirm',
        'isPaid',
        
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id');
    }
    public function country()
    {
        return $this->belongsTo(CountryExchange::class, 'country_exchange_id');
    }
}
