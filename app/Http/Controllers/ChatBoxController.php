<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Events\StatusUser;
use App\Models\Conversations;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatBoxController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', auth()->user()->id)->paginate(10);
        return view('home', compact('users'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $receiver = User::find($id);
        $check = $user->conversations()
            ->whereHas('participants', function ($query) use ($receiver) {
                $query->where('user_id', $receiver->id);
            })
            ->first();
        if ($check) {
            $messages = $check->messages;
        } else {
            $conversations = Conversations::create();
            $conversations->participants()->createMany([
                ['user_id' => $user->id],
                ['user_id' => $receiver->id],
            ]);
            $messages = $conversations->messages;
        }
        return view('chat', compact('receiver', 'messages'));
    }










    public function chat(Request $request, $id)
    {
        $user = Auth::user();
        $receiver = User::find($id);
        $check = $user->conversations()
            ->whereHas('participants', function ($query) use ($receiver) {
                $query->where('user_id', $receiver->id);
            })
            ->first();
        if ($check) {
            $conversations =  $check;
            $message = Message::create([
                'user_id' => $user->id,
                'conversation_id' => $conversations->id,
                'content' => $request->content
            ]);
            broadcast(new ChatEvent($receiver, $message));
            return $message;
        } else {
            $conversations = Conversations::create();
            $conversations->participants()->createMany([
                ['user_id' => $user->id],
                ['user_id' => $receiver->id],
            ]);
            $message = Message::create([
                'user_id' => $user->id,
                'conversation_id' => $conversations->id,
                'content' => $request->content
            ]);
            broadcast(new ChatEvent($receiver, $message));
            return $message;
        }
    }
}
