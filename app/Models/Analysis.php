<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'phase_id',
        'notes',
        'deadline',
        'timeline',
        'status',
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
        
    }

    public function phase()
    {
        return $this->belongsTo(phase::class);
        
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
        
    }

    public function file()
    {
        return $this->hasMany(File::class);
        
    }

    public function reason()
    {
        return $this->hasOne(Reason::class);
        
    }

    
}
