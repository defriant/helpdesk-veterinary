<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangImg;
use App\Models\Pesanan;
use App\Models\PesananBarang;
use App\Models\Notifikasi;
use Pusher\Pusher;
use Auth;
use Session;
use Str;

use function PHPUnit\Framework\fileExists;

class AdminController extends Controller
{
    public function notification_badge()
    {
        // Pesanan
        $menunggu_konfirmasi = Pesanan::where('status', 'menunggu_konfirmasi')->get();
        $validasi_pembayaran = Pesanan::where('status', 'menunggu_validasi')->get();
        $pengiriman = Pesanan::where('status', 'validasi')->get();

        $data = compact(
            'menunggu_konfirmasi',
            'validasi_pembayaran',
            'pengiriman'
        );
        return response()->json($data);
    }

    public function produk()
    {
        $data = Barang::all();
        return view('admin.produk', compact('data'));
    }

    public function produk_data()
    {
        $data = Barang::all();
        return view('admin.produk_data', compact('data'));
    }

    public function produk_data_kategori($kategori)
    {
        if ($kategori == "semua") {
            $data = Barang::all();
        } else {
            $data = Barang::where('jenis', $kategori)->get();
        }
        return view('admin.produk_data', compact('data'));
    }

    public function tambah_produk(Request $request)
    {
        $data_id_barang = Barang::where('id', 'like', "%" . Str::slug($request->nama) . "%")->get();
        if ($data_id_barang->count() > 0) {
            $new_id = $data_id_barang->count() + 1;
            $id_barang = Str::slug($request->nama) . '-' . $new_id;
        } else {
            $id_barang = Str::slug($request->nama);
        }

        $gambar = [];
        $time = time();

        $extension = $request->file('gambar_1')->getClientOriginalExtension();
        $request->file('gambar_1')->move('user/barang_img/', $id_barang . '-' . $time . '-image-1.' . $extension);
        $gambar[] = $id_barang . '-' . $time . '-image-1.' . $extension;

        $extension = $request->file('gambar_2')->getClientOriginalExtension();
        $request->file('gambar_2')->move('user/barang_img/', $id_barang . '-' . $time . '-image-2.' . $extension);
        $gambar[] = $id_barang . '-' . $time . '-image-2.' . $extension;

        $extension = $request->file('gambar_3')->getClientOriginalExtension();
        $request->file('gambar_3')->move('user/barang_img/', $id_barang . '-' . $time . '-image-3.' . $extension);
        $gambar[] = $id_barang . '-' . $time . '-image-3.' . $extension;

        Barang::create([
            'id' => $id_barang,
            'jenis' => $request->kategori,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stock' => $request->stock,
            'gambar' => $gambar[0],
            'deskripsi' => $request->deskripsi,
            'terjual' => 0,
            'dilihat' => 0
        ]);

        foreach ($gambar as $g) {
            BarangImg::create([
                'id_barang' => $id_barang,
                'gambar' => $g
            ]);
        }

        return response()->json("success");
    }

    public function update_produk(Request $request, $id)
    {
        $barang = Barang::find($id);
        $time = time();

        if ($request->hasFile('gambar_1')) {
            $imageName = $barang->barangimg[0]->gambar;
            $path = public_path('user/barang_img/' . $imageName);
            if (file_exists($path)) {
                unlink($path);
            }

            $extension = $request->file('gambar_1')->getClientOriginalExtension();
            $request->file('gambar_1')->move('user/barang_img/', $id . '-' . $time . '-image-1.' . $extension);

            Barang::where('id', $id)->update([
                'gambar' => $id . '-' . $time . '-image-1.' . $extension
            ]);

            $barang->barangimg[0]->update([
                'gambar' => $id . '-' . $time . '-image-1.' . $extension
            ]);
        }

        if ($request->hasFile('gambar_2')) {
            $imageName = $barang->barangimg[1]->gambar;
            $path = public_path('user/barang_img/' . $imageName);
            if (file_exists($path)) {
                unlink($path);
            }

            $extension = $request->file('gambar_2')->getClientOriginalExtension();
            $request->file('gambar_2')->move('user/barang_img/', $id . '-' . $time . '-image-2.' . $extension);

            $barang->barangimg[1]->update([
                'gambar' => $id . '-' . $time . '-image-2.' . $extension
            ]);
        }

        if ($request->hasFile('gambar_3')) {
            $imageName = $barang->barangimg[2]->gambar;
            $path = public_path('user/barang_img/' . $imageName);
            if (file_exists($path)) {
                unlink($path);
            }

            $extension = $request->file('gambar_3')->getClientOriginalExtension();
            $request->file('gambar_3')->move('user/barang_img/', $id . '-' . $time . '-image-3.' . $extension);

            $barang->barangimg[2]->update([
                'gambar' => $id . '-' . $time . '-image-3.' . $extension
            ]);
        }

        Barang::where('id', $id)->update([
            'jenis' => $request->kategori,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stock' => $request->stock,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json("success");
    }

    public function delete_produk($id)
    {
        Barang::where('id', $id)->delete();
        $barangImage = BarangImg::where('id_barang', $id)->get();
        foreach ($barangImage as $img) {
            $path = public_path('user/barang_img/' . $img->gambar);
            unlink($path);
        }
        BarangImg::where('id_barang', $id)->delete();

        return response()->json("success");
    }

    public function cari_produk($id)
    {
        $data = Barang::where('nama', 'like', "%" . $id . "%")->get();
        return view('admin.produk_data', compact('data'));
    }

    public function menunggu_konfirmasi()
    {
        $data = Pesanan::where('status', 'menunggu_konfirmasi')->get();
        return view('admin.pesanan.menunggu-konfirmasi', compact('data'));
    }

    public function menunggu_konfirmasi_data()
    {
        $data = Pesanan::where('status', 'menunggu_konfirmasi')->get();
        return view('admin.pesanan.menunggu-konfirmasi-data', compact('data'));
    }

    public function konfirmasi_pesanan(Request $request, $id)
    {
        $data_pesanan = Pesanan::find($id);
        $user_id = $data_pesanan->user_id;

        // foreach ($data_pesanan->pesananbarang as $pb) {
        //     $data_barang = Barang::find($pb->barang_id);
        //     if ($data_barang->stock < $pb->jumlah) {

        //     }
        // }

        Pesanan::where('id', $id)->update([
            'ongkir' => $request->ongkir,
            'total' => $data_pesanan->total + $request->ongkir,
            'status' => 'konfirmasi',
            'konfirmasi' => date('Y-m-d H:i:s')
        ]);

        foreach ($data_pesanan->pesananbarang as $pb) {
            $data_barang = Barang::find($pb->barang_id);
            Barang::where('id', $pb->barang_id)->update([
                'stock' => $data_barang->stock - $pb->jumlah,
                'terjual' => $data_barang->terjual + $pb->jumlah
            ]);
        }

        Notifikasi::create([
            'user_id' => $user_id,
            'jenis' => 'pesanan',
            'notif' => 'Pesananmu telah dikonfirmasi oleh admin',
            'url' => '/pesanan/' . $id,
            'is_read' => 0
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
        $data_notif = ['to_user_id' => $user_id, 'pesanan_id' => $id];
        $pusher->trigger('user-channel', 'pesanan-event', $data_notif);

        $data = Pesanan::where('status', 'menunggu_konfirmasi')->get();
        return view('admin.pesanan.menunggu-konfirmasi-data', compact('data'));
    }

    public function batal_pesanan(Request $request)
    {
        $data_pesanan = Pesanan::find($request->id_pesanan);
        $user_id = $data_pesanan->user_id;

        Pesanan::where('id', $request->id_pesanan)->update([
            'status' => 'batal',
            'alasan_batal' => $request->alasan_pembatalan
        ]);

        Notifikasi::create([
            'user_id' => $user_id,
            'jenis' => 'pesanan',
            'notif' => 'Pesananmu dibatalkan oleh admin, Note : ' . $request->alasan_pembatalan,
            'url' => '/pesanan/' . $request->id_pesanan,
            'is_read' => 0
        ]);

        // Kirim notif ke user
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
        $data_notif = ['to_user_id' => $user_id, 'pesanan_id' => $request->id_pesanan];
        $pusher->trigger('user-channel', 'pesanan-event', $data_notif);

        $data = Pesanan::where('status', 'menunggu_konfirmasi')->get();
        return view('admin.pesanan.menunggu-konfirmasi-data', compact('data'));
    }

    public function validasi_pembayaran()
    {
        $data = Pesanan::where('status', 'menunggu_validasi')->get();
        return view('admin.pesanan.validasi-pembayaran', compact('data'));
    }

    public function validasi_pembayaran_data()
    {
        $data = Pesanan::where('status', 'menunggu_validasi')->get();
        return view('admin.pesanan.validasi-pembayaran-data', compact('data'));
    }

    public function pembayaran_valid($id)
    {
        $data_pesanan = Pesanan::find($id);
        $user_id = $data_pesanan->user_id;

        Pesanan::where('id', $id)->update([
            'status' => 'validasi',
            'validasi' => date('Y-m-d H:i:s')
        ]);

        PesananBarang::where('pesanan_id', $id)->update([
            'terjual' => 'terjual'
        ]);

        Notifikasi::create([
            'user_id' => $user_id,
            'jenis' => 'pembayaran',
            'notif' => 'Pembayaran telah divalidasi',
            'url' => '/pesanan/' . $id,
            'is_read' => 0
        ]);

        // Kirim notif ke user
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
        $data_notif = ['to_user_id' => $user_id, 'pesanan_id' => $id];
        $pusher->trigger('user-channel', 'pesanan-event', $data_notif);

        $data = Pesanan::where('status', 'menunggu_validasi')->get();
        return view('admin.pesanan.validasi-pembayaran-data', compact('data'));
    }

    public function pembayaran_invalid($id)
    {
        $data_pesanan = Pesanan::find($id);
        $user_id = $data_pesanan->user_id;

        $foto_bukti_pembayaran = public_path('user/bukti_pembayaran/' . $data_pesanan->bukti_pembayaran);
        unlink($foto_bukti_pembayaran);

        Pesanan::where('id', $id)->update([
            'status' => 'validasi_invalid',
            'bukti_pembayaran' => null
        ]);

        Notifikasi::create([
            'user_id' => $user_id,
            'jenis' => 'pembayaran',
            'notif' => 'Bukti pembayaran tidak valid',
            'url' => '/pesanan/' . $id,
            'is_read' => 0
        ]);

        // Kirim notif ke user
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
        $data_notif = ['to_user_id' => $user_id, 'pesanan_id' => $id];
        $pusher->trigger('user-channel', 'pesanan-event', $data_notif);

        $data = Pesanan::where('status', 'menunggu_validasi')->get();
        return view('admin.pesanan.validasi-pembayaran-data', compact('data'));
    }

    public function pengiriman()
    {
        $data = Pesanan::where('status', 'validasi')->get();
        return view('admin.pesanan.pengiriman', compact('data'));
    }

    public function antar($id)
    {
        $data_pesanan = Pesanan::find($id);
        $user_id = $data_pesanan->user_id;

        Pesanan::where('id', $id)->update([
            'status' => 'pengiriman',
            'pengiriman' => date('Y-m-d H:i:s')
        ]);

        Notifikasi::create([
            'user_id' => $user_id,
            'jenis' => 'pesanan',
            'notif' => 'Pesananmu sedang dikirim ke ' . $data_pesanan->alamat,
            'url' => '/pesanan/' . $id,
            'is_read' => 0
        ]);

        // Kirim notif ke user
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
        $data_notif = ['to_user_id' => $user_id, 'pesanan_id' => $id];
        $pusher->trigger('user-channel', 'pesanan-event', $data_notif);

        $data = Pesanan::where('status', 'validasi')->get();
        return view('admin.pesanan.pengiriman-data', compact('data'));
    }

    public function konfirmasi_tiba_di_tujuan()
    {
        $data = Pesanan::where('status', 'pengiriman')->get();
        return view('admin.pesanan.tiba-di-tujuan', compact('data'));
    }

    public function tiba_di_tujuan($id)
    {
        $data_pesanan = Pesanan::find($id);
        $user_id = $data_pesanan->user_id;

        Pesanan::where('id', $id)->update([
            'status' => 'selesai',
            'tiba_di_tujuan' => date('Y-m-d H:i:s')
        ]);

        Notifikasi::create([
            'user_id' => $user_id,
            'jenis' => 'pesanan',
            'notif' => 'Pesananmu telah tiba di tujuan, pesanan selesai',
            'url' => '/pesanan/' . $id,
            'is_read' => 0
        ]);

        // Kirim notif ke user
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
        $data_notif = ['to_user_id' => $user_id, 'pesanan_id' => $id];
        $pusher->trigger('user-channel', 'pesanan-event', $data_notif);

        $data = Pesanan::where('status', 'pengiriman')->get();
        return view('admin.pesanan.tiba-di-tujuan-data', compact('data'));
    }

    public function semua_transaksi()
    {
        $pesanan = Pesanan::where('status', '!=', 'menunggu_konfirmasi')->orderByDesc('created_at')->get();
        return view('admin.semua-transaksi', compact('pesanan'));
    }

    public function detail_pesanan($id)
    {
        $pesanan = Pesanan::find($id);
        return view('admin.detail-pesanan', compact('pesanan'));
    }

    public function semua_transaksi_data()
    {
        $pesanan = Pesanan::where('status', '!=', 'menunggu_konfirmasi')->orderByDesc('created_at')->get();
        return view('admin.semua-transaksi-data', compact('pesanan'));
    }

    public function cari_pesanan($id)
    {
        $pesanan = Pesanan::where('id', 'like', "%" . $id . "%")->orderByDesc('created_at')->get();
        return view('admin.semua-transaksi-data', compact('pesanan'));
    }

    public function get_laporan_transaksi(Request $request)
    {
        $data = Pesanan::whereMonth('created_at', date('m', strtotime($request->periode)))->whereYear('created_at', date('Y', strtotime($request->periode)))->where('status', 'selesai');
        $transaksi = $data->get();
        $transaksiData = [];
        $pendapatan = "Rp " . number_format($data->sum('total'));
        $terjual = 0;

        foreach ($transaksi as $t) {
            $terjual = $terjual + $t->pesananBarang->sum('jumlah');

            $harga = 0;
            foreach ($t->pesananBarang as $pb) {
                $harga = $harga + ($pb->harga * $pb->jumlah);
            }

            $transaksiData[] = [
                "id" => $t->id,
                "nama" => $t->nama,
                "tanggal" => date('d/m/Y', strtotime($t->created_at)),
                "jumlah_unit" => $t->pesananBarang->sum('jumlah'),
                "harga" => "Rp " . number_format($harga),
                "ongkir" => "Rp " . number_format($t->ongkir),
                "total" => "Rp " . number_format($t->total)
            ];
        }

        $response = [
            "transaksi" => $transaksiData,
            "pendapatan" => $pendapatan,
            "terjual" => $terjual
        ];
        return response()->json($response);
    }
}
