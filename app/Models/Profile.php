<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'designation_id',
        'userimage_id',
        'nric_no',
        'phone_no',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
        
    }


}
