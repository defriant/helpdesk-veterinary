<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\Chat;
use App\Models\User;
use App\Models\Barang;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\PesananBarang;

class OwnerController extends Controller
{

    public function dashboard()
    {
        // Carbon::setWeekStartsAt(Carbon::SUNDAY);
        // Carbon::setWeekEndsAt(Carbon::SATURDAY);

        $hari_ini = PesananBarang::whereDate('created_at', '=', date('Y-m-d'))->get();
        $bulan_ini = PesananBarang::whereMonth('created_at', '=', date('m'))->get();
        $semua = PesananBarang::all();
        $produk_terlaris = Barang::where('terjual', '>', 0)->orderByDesc('terjual')->take(4)->get();
        $sering_dilihat = Barang::where('dilihat', '>', 10)->orderByDesc('dilihat')->take(4)->get();
        $produk = Barang::all();
        $transaksi_terbaru = Pesanan::where('status', '!=', 'menunggu_konfirmasi')->orderByDesc('created_at')->take(5)->get();

        return view('owner.dashboard', compact(
            'hari_ini',
            'bulan_ini',
            'semua',
            'produk_terlaris',
            'sering_dilihat',
            'produk',
            'transaksi_terbaru'
        ));
    }

    public function produk_data()
    {
        $produk = Barang::all();
        return view('owner.produk-data', compact('produk'));
    }

    public function produk_by_kategori($kategori)
    {
        $produk = Barang::where('jenis', $kategori)->get();
        return view('owner.produk-data', compact('produk'));
    }

    public function cari_produk($id)
    {
        $produk = Barang::where('nama', 'like', "%" . $id . "%")->get();
        return view('owner.produk-data', compact('produk'));
    }

    public function detail_pesanan($id)
    {
        $pesanan = Pesanan::find($id);
        return view('admin.detail-pesanan', compact('pesanan'));
    }

    public function semua_transaksi()
    {
        $pesanan = Pesanan::where('status', '!=', 'menunggu_konfirmasi')->orderByDesc('created_at')->get();
        return view('owner.semua-transaksi', compact('pesanan'));
    }

    public function semua_transaksi_data()
    {
        $pesanan = Pesanan::where('status', '!=', 'menunggu_konfirmasi')->orderByDesc('created_at')->get();
        return view('owner.semua-transaksi-data', compact('pesanan'));
    }

    public function cari_pesanan($id)
    {
        $pesanan = Pesanan::where('id', 'like', "%" . $id . "%")->orderByDesc('created_at')->get();
        return view('owner.semua-transaksi-data', compact('pesanan'));
    }

    public function chat_get_users()
    {
        $chat = Chat::where('from_user', '!=', Auth::user()->id)->get();
        $users_id = [];
        $users = [];

        foreach ($chat as $c) {
            $check = array_search($c->from_user, $users_id);
            if ($check === false) {
                $users_id[] = $c->from_user;
            }
        }

        foreach ($users_id as $u) {
            $data = User::find($u);
            $users[] = [
                "id" => $data->id,
                "name" => $data->name,
                "unread" => Chat::where('from_user', $data->id)->where('is_read', false)->get()->count()
            ];
        }

        return response()->json($users);
    }

    public function chat_get_message(Request $request)
    {
        $chat = Chat::where('from_user', $request->user_id)->orWhere('to_user', $request->user_id)->get();
        return response()->json([
            "chat" => $chat,
            "my_id" => Auth::user()->id
        ]);
    }

    public function chat_read_message(Request $request)
    {
        Chat::where('from_user', $request->from_user)->update([
            "is_read" => true
        ]);
        return response()->json([]);
    }

    public function chat_send_message(Request $request)
    {
        Chat::create([
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
        // $notif_data = ['pesanan_id' => $id_pesanan];
        $data = [
            "to" => $request->to_user,
            "message" => $request->message
        ];
        $pusher->trigger('user-channel', 'chat-event', $data);

        return response()->json([
            "response" => true,
            "message" => ""
        ]);
    }
}
