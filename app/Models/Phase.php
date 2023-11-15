<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;

    protected $fillable = [
        'phase_name',
    ];

    function getPhase() //display all designation in select option
    {
        return Phase::orderBy('id','ASC')->get();
    }
}
