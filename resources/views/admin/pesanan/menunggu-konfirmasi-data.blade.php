
@if ($data->count() > 0)
    
    @foreach ($data as $d)

    <div class="panel panel-default">
        <div class="panel-head">
            <h5><i class="fas fa-shopping-bag" style="margin-right: 5px; color: coral"></i>Pesanan</h5>
            <h5 style="margin-left: 10px">{{ date("d M Y", strtotime($d->created_at)) }}</h5>
            <h5 style="margin-left: 10px">ID. {{ $d->id }}</h5>
            <h5 style="margin-left: 10px; color: rgb(255, 153, 0)"><b><i class="far fa-clock"></i> MENUNGGU KONFIRMASI</b></h5>
        </div>
        <div class="col-xs-12">
            <h5>Pesanan oleh, <b>{{ $d->nama }}</b></h5>
            <h5>{{ $d->alamat }}</h5>
            <h5>Telp : {{ $d->telp }}</h5>
        </div>
        <div class="panel-body">
            <div class="col-xs-12 col-md-8">
                @foreach ($d->pesananbarang as $pb)
                <div class="col-xs-12 col-sm-6">
                    <div class="pesanan-item">
                        <img src="{{ asset('user/barang_img/'.$pb->gambar) }}" width="70px" height="70px" alt="">
                        <ul style="list-style-type: none">
                            <li><h5 style="font-size: 14px; margin-left: -25px;"><b>{{ $pb->nama }}</b></h5></li>
                            <li><h5 style="font-size: 13px; margin-left: -25px; margin-top: 10px">{{ $pb->jumlah }} Barang x {{ number_format($pb->harga) }}</h5></li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="pesanan-harga">
                    <hr class="pesanan-harga-hr">
                    <h5>Total Belanja</h5>
                    <h4><b>Rp {{ number_format($d->total) }}</b></h4>
                    <br>
                    <h5>Ongkos Kirim</h5>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Rp</span>
                                <input type="text" id="ongkir" class="form-control input-number currency-input" placeholder="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    
                    <button onclick="konfirmasi({{ $d->id }})" class="btn-konfirmasi-transaksi"><h4 style="color: rgb(0, 173, 0)"><i class="far fa-check-circle" style="margin-right: 5px"></i> Konfirmasi</h4></button>
                    <button data-idpesanan="{{ $d->id }}" class="btn-batal-transaksi" data-toggle="modal" data-target="#modal-batal"><h4 style="color: red"><i class="far fa-times-circle" style="margin-right: 5px"></i> Batalkan</h4></button>
                </div>
            </div>
        </div>
    </div>

    @endforeach

@else

    <div style="text-align: center; margin-bottom: 200px; margin-top: 100px; opacity: 0.5">
        <i class="far fa-shopping-bag" style="font-size: 50px; margin-bottom: 10px"></i>
        <h4><b>Belum ada pesanan</b></h4>
    </div>

@endif