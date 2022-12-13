<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Komplain;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class KomplainController extends Controller
{
    public function getKomplainData()
    {
        $data = Komplain::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $unread = 0;

        foreach ($data as $key => $value) {
            $chat = $value->chat()->orderBy('created_at')->get();
            $chat_unread = $chat->where('to_user', Auth::user()->id)->where('is_read', 0)->count();

            $data[$key]["chat"] = $chat;
            $data[$key]["unread"] = $chat_unread;

            $unread += $chat_unread;
        }

        return [
            'data' => $data,
            'unread' => $unread
        ];
    }

    public function get()
    {
        return response()->json($this->getKomplainData());
    }

    public function add(Request $request)
    {
        $komplain_id = "K" . Auth::user()->id . "-" . time();

        Komplain::create([
            'id' => $komplain_id,
            'user_id' => Auth::user()->id,
            'subjek' => $request->subjek
        ]);

        $admin_id = User::where('role', 'admin')->first()->id;

        $chat = Chat::create([
            "komplain_id" => $komplain_id,
            "from_user" => Auth::user()->id,
            "to_user" => $admin_id,
            "message" => $request->message,
            "is_read" => false
        ]);

        $options = [
            'cluster' => 'ap1',
            'useTLS' => true,
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $chat_data = [
            "komplain_id" => $komplain_id,
            "from" => Auth::user()->id,
            "chat" => $chat,
            "message" => $request->message
        ];

        $pusher->trigger('admin-channel', 'chat-event', $chat_data);

        return response()->json([
            'komplain_id' => $komplain_id,
            'subjek' => $request->subjek,
            'chat' => Chat::where('komplain_id', $komplain_id)->get(),
            'komplain' => $this->getKomplainData()
        ]);
    }
}
