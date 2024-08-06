<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDetail extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    public $table = 'member_details';

    protected $fillable = [
        'referral_code',
        'principal_id',

        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'present_address',
        'permanent_address',
        'home_phone',
        'mobile_no',
        'email_address',
        'place_of_birth',
        'date_of_birth',
        'age',
        'height',
        'weight',
        'citizenship',
        'gender',
        'civil_status',
        'employment_status',
        'employer_business_name',
        'nature_of_business',
        'business_address',
        'type_of_account',
        'type_of_program',
        'dental',
        'membership_type',
        'philhealth_no',
        'spouse_name',
        'spouse_philhealth_no',
        'telephone_number',
        'cellphone_number',
        'name_beneficial_owner',
        'name_beneficiary',
        'nationality',
        'proof_id',
        'source_fund',
        'tin',
        'sss_gsis',
        'isSaveByUser',

        'endorse_to',
        'status',
        'statusUser',

        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'referral_code','referral_code');
    }

    public function plancode()
    {
        return $this->belongsTo(MemberPlanCode::class,'id', 'member_id');
    }

    public function memberHealth()
    {
        return $this->belongsTo(MemberDetailHealth::class,'id', 'member_id');
    }

    public function uploadFile()
    {
        return $this->belongsTo(FileUpload::class,'id', 'member_id');
    }

    public function uploadReceipt()
    {
        return $this->belongsTo(FileReceipt::class,'id', 'member_id');
    }

    public function dependents()
    {
        return $this->hasMany(MemberDetailDependent::class,'principal_id', 'id');
    }
    public function principal()
    {
        return $this->belongsTo(MemberDetailDependent::class,'principal_id', 'id');
    }
    public function quatations()
    {
        return $this->hasMany(Quatation::class,'member_id', 'id');
    }
    public function activities()
    {
        return $this->hasMany(Activity::class,'member_id', 'id');
    }

}
