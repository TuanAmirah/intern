<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;
    protected $fillable = [
        'analysis_id',
        'user_id',
        'issue',
    ];

    public function analysis()
    {
        return $this->belongsTo(Analysis::class);
        
    }

    public function respon()
    {
        return $this->hasMany(Respon::class);
        
    }
    
}
