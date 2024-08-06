<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quatation extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    public $table = 'quatations';

    protected $fillable = [
        'member_id',
        'item',
        'amount',
        'isAddCharge',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function member()
    {
        return $this->belongsTo(MemberDetail::class, 'member_id', 'id');
    }

}
