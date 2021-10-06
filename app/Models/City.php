<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public $table = 'philippine_cities';

    protected $fillable = [
        'psgc_code',
        'city_municipality_description',
        'region_description',
        'province_code',
        'city_municipality_code',

        'created_at',
        'updated_at',
       
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code' , 'province_code');
    }
}
