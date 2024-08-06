<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPlanCode extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    public $table = 'member_plan_codes';

    protected $fillable = [
        'plm_id',
        'plm_code',
        'plm_room',
        'plm_acct_type',
        'plm_mop',
        'plm_bvat',
        'plm_evat',
        'plm_mem_fee',
        'member_id',
        
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function member()
    {
        return $this->belongsTo(MemberDetail::class, 'member_id');
    }
}
