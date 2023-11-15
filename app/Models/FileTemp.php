<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileTemp extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_no',
        'file_name',
        'file_type',
        'file_size',
        'file_path',
    ];


}
