<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CountryExchange extends Model
{
     use SoftDeletes , HasFactory;

     protected $fillable = [
        'country',
        'code',
        'exchange',

        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function exchange_records()
    {
        return $this->hasMany(CountryExchangeRecord::class, 'country_exchange_id' , 'id')->latest();
    }
}
