<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'chat_room_id' => 'required|exists:chat_rooms,id',
            'nickname' => 'required|string|max:8',
            'message' => 'required|string|max:255',
        ]);

        $message = Message::create($request->all());
        return response()->json($message, 201);
    }

    public function index($chatRoom)
    {
        return response()->json(Message::where('chat_room_id', $chatRoom)->get());
    }
}