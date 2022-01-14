<?php

namespace App\Models;

use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, Notifiable, HasApiTokens;

    public $table = 'users';
    
    protected $fillable = [
        //personal info
        'email',
        'firstname',
        'middlename',
        'lastname',
        'date_of_birth',
        'occupation',
        'id_type',
        'id_number',
        'id_issued_country',
        'id_issue_date',
        'id_expiry_date',
        'gender',
        'source_of_fund',
        'id_card_front',
        'id_card_back',
        'nationality',
        //contact info
        'country',
        'address',
        'mobile_number',
        'telephone',
        'terms_and_conditions',
        'isRegistered',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
        'email_verified_at',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
