<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'analysis_id',
    //     'ref_no',
    //     'file_name',
    //     'file_type',
    //     'file_size',
    //     'file_path',
    // ];
        protected $guarded=[];
    public function analysis()
    {
        return $this->belongsTo(Analysis::class);
    }
}
