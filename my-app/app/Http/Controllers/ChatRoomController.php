<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index()
    {
        $chatRooms = ChatRoom::all();
        return view('chatrooms.index', ['chatRooms' => $chatRooms]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $chatRoom = ChatRoom::create($request->all());
        return redirect()->route('chatRooms.index');
    }

    public function show(ChatRoom $chatRoom)
    {
        return view('chatrooms.show', ['chatRoom' => $chatRoom]);
    }
}
