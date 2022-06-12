@extends('layouts.user_ui')
@section('content')

<div class="checkout">
    <div class="container">
        <h3 style="color: orange">Daftar Pesanan</h3>
        @if (Auth::user()->pesanan->count() > 0)
            @foreach (Auth::user()->pesanan->sortByDesc('created_at') as $p)
                <div class="pesanan-list">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <h5 style="font-size: 12px"><i class="fas fa-shopping-bag" style="margin-right: 5px; color: coral"></i>Pesanan</h5>
                            <h5 style="font-size: 12px; margin-left: 10px">{{ date("d M Y", strtotime($p->created_at)) }}</h5>
                            @if ($p->status == 'menunggu_konfirmasi')
                                <h5 class="status-process">Menunggu Konfirmasi Pesanan</h5>
                            @elseif ($p->status == 'konfirmasi')
                                <h5 class="status-process">Pembayaran</h5>
                            @elseif ($p->status == 'batal')
                                <h5 class="status-invalid">Dibatalkan Oleh Admin</h5>
                            @elseif ($p->status == 'menunggu_validasi')
                                <h5 class="status-process">Menunggu Validasi Pembayaran</h5>
                            @elseif ($p->status == 'validasi')
                                <h5 class="status-process">Pengiriman</h5>
                            @elseif ($p->status == 'validasi_invalid')
                                <h5 class="status-invalid">Pembayaran Tidak Valid</h5>
                            @elseif ($p->status == 'pengiriman')
                                <h5 class="status-process">Pengiriman</h5>
                            @elseif ($p->status == 'tiba_di_tujuan')
                                <h5 class="status-process">Tiba Di Tujuan</h5>
                            @elseif ($p->status == 'selesai')
                                <h5 class="status-done">Selesai</h5>
                            @endif
                            
                            <h5 style="font-size: 12px; margin-left: 10px">ID. {{ $p->id }}</h5>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12 col-md-8">
                                @foreach ($p->pesananbarang as $pb)
                                <div class="col-xs-12 col-sm-6">
                                    <div class="pesanan-item">
                                        <img src="{{ asset('user/barang_img/'.$pb->gambar) }}" width="70px" height="70px" alt="">
                                        <ul style="list-style-type: none">
                                            <li><h5 style="font-size: 13px; margin-left: 10px"><b>{{ $pb->nama }}</b></h5></li>
                                            <li><h5 style="font-size: 12px; margin-left: 10px; margin-top: 10px">{{ $pb->jumlah }} Barang x Rp {{ number_format($pb->harga) }}</h5></li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="pesanan-harga">
                                    <hr class="pesanan-harga-hr">
                                    <h5>Total Belanja</h5>
                                    <br>
                                    <h4><b>Rp {{ number_format($p->total) }}</b></h4>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="detail-transaksi">
                                    @if ($p->status == 'menunggu_konfirmasi')
                                    <button data-href="{{ '/pesanan/batal/'.$p->id }}" class="btn-batal-transaksi"><h5 style="color: red"><i class="far fa-times-circle" style="margin-right: 5px"></i> Batalkan Pesanan</h5></button>
                                    @endif
                                    @if ($p->status == 'tiba_di_tujuan')
                                    <button data-href="{{ '/pesanan/selesai/'.$p->id }}" class="btn-selesai-transaksi"><h5 style="color: rgb(0, 173, 0)"><i class="far fa-check-circle" style="margin-right: 5px"></i> Pesanan Selesai</h5></button>
                                    @endif
                                    <button data-href="{{ '/pesanan/'.$p->id }}" class="btn-detail-transaksi"><h5 style="color: black"><i class="far fa-info-circle" style="margin-right: 5px"></i> Lihat Pesanan</h5></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div style="text-align: center; color: #999 !important; margin-top: 150px; margin-bottom: 100px">
                <i class="fal fa-shopping-bag" style="font-size: 80px;"></i>
                <br><br>
                <h5>Belum ada pesanan.</h5>
                <br>
                <button class="btn-belanja"><h5><i class="far fa-shopping-bag" style="margin-right: 5px"></i> Belanja sekarang</h5></button>
            </div>
        @endif
        
    </div>
</div>

@endsection

@section('scripts')
<script>
    $('.btn-detail-transaksi').on('click', function(){
        window.location = $(this).data('href');
    })

    $('.btn-batal-transaksi').on('click', function(){
        var result = confirm("Anda yakin ingin membatalkan pesanan ?");
        if (result) {
            window.location = $(this).data('href');
        }
    })

    $('.btn-selesai-transaksi').on('click', function(){
        window.location = $(this).data('href');
    })

    $('.btn-belanja').on('click', function(){
        window.location = '/';
    })
</script>
@endsection