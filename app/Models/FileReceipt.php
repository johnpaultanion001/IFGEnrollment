<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileReceipt extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    public $table = 'file_receipts';

    protected $fillable = [
        'file',
        'member_id',
        'user_id',
        'reference_number',
        'amount_paid',
        'status',
    
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
