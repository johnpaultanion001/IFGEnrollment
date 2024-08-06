<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    public $table = 'file_uploads';

    protected $fillable = [
        'file',
        'member_id',
        'user_id',
        
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
