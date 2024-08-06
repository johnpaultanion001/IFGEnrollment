<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndorceToMda extends Model
{
    use HasFactory;
    protected $connection = 'second_db';
    public $table = 'ifg_enrollment';

    protected $fillable = [
        'id',
        'af_ifg_account_source',
        'af_ifg_account_type',
        'af_ifg_name',
        'af_ifg_address',
        'af_ifg_city',
        'af_ifg_contact_person',
        'af_ifg_contact_number',
        'af_ifg_mbl',
        'af_ifg_plan_type',
        'af_ifg_room_type',
        'af_ifg_mop',
        'af_ifg_mem_fee',
        'af_ifg_proc_fee',
        'af_ifg_net_access',
        'af_ifg_status',

        'created_at',
        'updated_at',
        'af_ifg_ma_code',
        'af_ifg_ref_id',
        'af_ifg_req_by',
        'af_ifg_req_dept',

        'af_ifg_direct_sales',
        'af_ifg_referrer_fullname',
        'af_ifg_acc_cac_name',
        'af_ifg_cam_name',
        'af_ifg_sales_manager',
        'af_ifg_sales_remarks',
        'af_ifg_ac_code',
        'af_ifg_member_count',

      
    ];

}
