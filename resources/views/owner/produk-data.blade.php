<div class="row">
    @foreach ($produk as $p)
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
            <div class="owner-produk" style="margin-bottom: 30px">
                <img class="produk-img" src="{{ asset('user/barang_img/'.$p->gambar) }}" alt="">
                <div class="owner-produk-text">
                    <h5 style="font-size: 15px" title="{{ $p->nama }}">{{ $p->nama }}</h5>
                </div>
                <h5 style="font-size: 16px"><b>Rp {{ number_format($p->harga) }}</b></h5>
                <h5 style="font-size: 14px">Stok {{ $p->stock }} {{ $p->jenis_stock }}</h5>
                <h5 style="font-size: 14px"><i class="fas fa-eye"></i> {{ $p->dilihat }} &nbsp;|&nbsp; Terjual {{ $p->terjual }} {{ $p->jenis_stock }}</h5>
            </div>
        </div>
    @endforeach
</div>