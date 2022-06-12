<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Str;

class ApiController extends Controller
{
    public function products()
    {
        $data = Barang::all();
        foreach ($data as $product) {
            $product['gambar'] = asset('user/barang_img/'.$product->gambar);
        }
        return response()->json($data);
    }

    public function product($id)
    {
        $data = Barang::find($id);
        if ($data) {
            $data['gambar'] = asset('user/barang_img/'.$data->gambar);
            return response()->json($data);
        }else {
            return response()->json($id." not found");
        }
    }

    public function add_product(Request $request)
    {
        $fileNameWithExt = $request->file('gambar')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $fileExt = $request->file('gambar')->getClientOriginalExtension();
        $gambar = $fileName.'-'.time().'.'.$fileExt;
        $request->file('gambar')->move('user/barang_img/', $gambar);

        $data_id_barang = Barang::where('id', 'like', "%".Str::slug($request->nama)."%")->get();
        if ($data_id_barang->count() > 0) {
            $new_id = $data_id_barang->count() + 1;
            $id_barang = Str::slug($request->nama).'-'.$new_id;
        }else{
            $id_barang = Str::slug($request->nama);
        }

        $addProduct = Barang::create([
            'id' => $id_barang,
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stock' => $request->stock,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
            'terjual' => 0,
            'dilihat' => 0
        ]);

        return $addProduct;
    }

    public function update_product(Request $request, $id)
    {
        if ($request->hasFile('gambar')) {
            $time = time();
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->move('user/barang_img/',$filename.'_'.$time.'.'.$extension);
            $gambar = $filename.'_'.$time.'.'.$extension;

            Barang::where('id', $id)->update([
                'jenis' => $request->jenis,
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stock' => $request->stock,
                'gambar' => $gambar,
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json($id." Updated");
        }else{
            Barang::where('id', $id)->update([
                'jenis' => $request->jenis,
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stock' => $request->stock,
                'deskripsi' => $request->deskripsi,
            ]);
            
            return response()->json($id." Updated");
        }
    }

    public function search_product(Request $request)
    {
        $data = Barang::where('nama', 'like', '%'.$request->p.'%')->get();
        return response()->json($data);
    }
}
