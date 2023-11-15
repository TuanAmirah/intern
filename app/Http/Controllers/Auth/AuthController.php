<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    
    public function register()
    {
        return view('register');
    }

    public function storeRegister(Request $request)
    {
       $validation = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required',
        'password' => 'required|confirmed|min:8'
       ]);

       $create = User::create($validation);

       if(!$create)
       {
        return redirect()->back()->with("Error", "Register unsuccesfully");
       }

       return redirect('login');
    }

    // public function storeLogin(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //        ]);

    //     if (Auth::attempt($credentials)) {
            
 
    //         return redirect('dashboard');
    //     }
 
    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ])->onlyInput('email');



    // }

    public function storeLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) 
        {
            $request->session()->regenerate();

            if (auth()->user()->role == 'Admin') 
            {
                return redirect()->route('dashboard');
            }
            else if (auth()->user()->role == 'System Analyst') {
                return redirect()->route('dashboard');
            }
            else if (auth()->user()->role == 'System Developer') {
                return redirect()->route('dashboard.developer');
            }
             else {
                return redirect('login');
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->regenerate();
        return redirect('/login');
    }

    public function changePassword(Request $request) 
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ], [
            'password_confirmation' => 'The new password and confirmation do not match.',
        ]);

        

        $user = User::find(Auth::user()->id);  // get the id user

        // dd($user);

        if (Hash::check($request->input('current_password'), $user->password)) 
        {

            $user->updatePassword($request->password);

            return redirect()->route('user')->with('success', 'Successfully changed password');
        } 
        else 
        {
            return redirect()->route('user')->with('error', 'Wrong Current Password, please try again');
            // return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        
    }

 
}
