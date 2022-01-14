<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryExchangeRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_exchange_id',
        'exchange',
        'created_at',
        'updated_at',
    ];

    public function country()
    {
        return $this->belongsTo(CountryExchange::class, 'country_exchange_id');
    }
}
