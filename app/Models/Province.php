<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public $table = 'philippine_provinces';

    protected $fillable = [
        'psgc_code',
        'province_description',
        'region_code',
        'province_code',

        'created_at',
        'updated_at',
      
    ];
}
