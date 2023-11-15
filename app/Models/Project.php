<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
    ];

    function getProject() //display all designation in select option
    {
        return Project::orderBy('id','ASC')->get();
    }

    
}
