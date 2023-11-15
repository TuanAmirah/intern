<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = User::find(Auth::user()->id);    
        $image = $user->image;

        return view('dashboard',compact('image'));
    }

  

    public function createproject()
    {
        return view('create-project');
    }
   

    


    public function userProfile()
    {
        return view('user-profile');
    }
    
  
}
