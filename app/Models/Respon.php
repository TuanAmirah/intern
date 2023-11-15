<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respon extends Model
{
    use HasFactory;

    protected $fillable = [
        'reason_id',
        'user_id',
        'comment',
    ];

    public function reason()
    {
        return $this->belongsTo(Reason::class);  
    }

    public function user()
    {
        return $this->belongsTo(User::class);  
    }
    


}
