<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Komplain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class AdminKomplainController extends Controller
{
    public function komplain_view()
    {
        return view('admin.komplain');
    }

    public function get()
    {
        $data = Komplain::with('chat')->with('user')->orderBy('created_at', 'DESC')->get();
        $unread = 0;

        foreach ($data as $key => $value) {
            $chat = $value->chat()->orderBy('created_at')->get();
            $chat_unread = $chat->where('to_user', Auth::user()->id)->where('is_read', 0)->count();
            $data[$key]["unread"] = $chat_unread;

            $unread += $chat_unread;
        }

        return response()->json([
            'data' => $data,
            'unread' => $unread
        ]);
    }

    public function read_chat(Request $request)
    {
        Chat::where('komplain_id', $request->komplain_id)->where('to_user', Auth::user()->id)->update([
            "is_read" => true
        ]);
        return response()->json([]);
    }

    public function send(Request $request)
    {
        $chat = Chat::create([
            "komplain_id" => $request->komplain_id,
            "from_user" => Auth::user()->id,
            "to_user" => $request->to_user,
            "message" => $request->message,
            "is_read" => false
        ]);

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true,
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = [
            "komplain_id" => $request->komplain_id,
            "chat" => $chat
        ];

        $pusher->trigger('user-channel', 'user-' . $request->to_user . '-komplain-chanel', $data);

        return response()->json([
            "response" => true,
            "chat" => $chat
        ]);
    }
}
