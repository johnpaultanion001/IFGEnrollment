<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanCodeForIFGModel extends Model
{
    use HasFactory;
    protected $connection = 'second_db';
    public $table = 'mem_plancodes';

    protected $fillable = [
        'plm_id',
        'plm_code',
        'plm_room',
        'plm_acct_type',
        'plm_mop',
        'plm_bvat',
        'plm_evat',
        'plm_mem_fee',
        'mem_id',
        'created_date',
    ];

   
}
