<?php

namespace App\Http\Controllers;

use App\Models\Respon;
use Illuminate\Http\Request;

class ResponController extends Controller
{
    public function chat(Request $request,$id) 
    {
        $request->validate([
            'comment' => 'required',
        ]);    

        $create = Respon::create([
            'reason_id' => $request->reasonid,
            'user_id' =>$id,
            'comment' =>$request->comment,
        ]);


        if ($create) {
            return redirect()->back()->with('success', 'Task rejected');
        } else {
            return redirect()->back()->with('error', 'Task not found');
        }



        

    }
}
