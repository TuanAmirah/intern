<?php

namespace App\Http\Controllers;

use App\Events\Message;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function chatview()
    {
        return view('chat');
    }

    public function sendMessage(Request $request)
    {
        broadcast(new Message('user1'));

        return response()->json(['status' => 'Message Sent!']);
    }
}
