@foreach ($data as $d)
    <div class="col-sm-6 col-lg-4" style="margin-bottom: 50px;">
        <div class="product-name">
            <h4 style="position: relative; top: 10px">{{ $d->nama }}</h4> 
            <hr>
        </div>
        <div style="display: flex;">
            <img src="{{ asset('user/barang_img/'.$d->gambar) }}" style="width: 100px; height: 100px">
            <div style="">
                <ul style="list-style-type: none;">
                    <li>Rp {{ $d->harga }}</li>
                    <li>Stock {{ $d->stock }} {{ $d->jenis_stock }}</li>
                    <li><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-update-produk" style="margin-top: 15px"
                        data-idproduk="{{ $d->id }}"
                        {{-- data-upgambar="{{ asset('user/barang_img/'.$d->gambar) }}" --}}
                        data-upkategori="{{ $d->jenis }}"
                        data-upnama="{{ $d->nama }}"
                        data-upharga="{{ $d->harga }}"
                        data-upjenisstock="{{ $d->jenis_stock }}"
                        data-upstock="{{ $d->stock }}"
                        data-updeskripsi="{{ $d->deskripsi }}"
                        data-deleteproduk="/admin/delete-produk/{{ $d->id }}"
                        data-upgambar1="{{ asset('user/barang_img/' . $d->barangimg[0]->gambar) }}"
                        data-upgambar2="{{ asset('user/barang_img/' . $d->barangimg[1]->gambar) }}"
                        data-upgambar3="{{ asset('user/barang_img/' . $d->barangimg[2]->gambar) }}">
                            Update
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="stock" style="margin-top: 15px;">
            @if ($d->stock > 0)
            <span class="label label-success" style="margin-left: 12px;">STOK TERSEDIA</span>
            @else
                <span class="label label-danger" style="margin-left: 8px;">STOK HABIS</span>
            @endif
        </div>
    </div>
@endforeach