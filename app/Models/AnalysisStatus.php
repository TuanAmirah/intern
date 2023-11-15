<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'analysis_id',
        'status_id',
        'status_justify',
    ];

    public function analysis()
    {
        return $this->belongsTo(Analysis::class);
        
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
        
    }



}