<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function profile()
    {
        return $this->hasMany(Profile::class);
    }

    function getDesignation() //display all designation in select option
    {
        return Designation::orderBy('id','ASC')->get();
    }

  

 
}
