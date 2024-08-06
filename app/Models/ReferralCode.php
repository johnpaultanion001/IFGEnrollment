<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCode extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    public $table = 'referral_codes';

    protected $fillable = [
        'referral_code',
        'isUsed',
        'remarks',
        
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
