@extends('layouts.admin_ui')
@section('content')

<div class="main-content">
    <div class="container-fluid">
        
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">Monthly Overview</h3>
                <p class="panel-subtitle">Period: {{ date('M Y') }}</p>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="metric" style="border: 1px solid #00c853">
                            <span class="icon" style="background-color: #00c853"><i class="fa fa-shopping-bag"></i></span>
                            <p>
                                <span class="number" style="color: #00c853">{{ $hari_ini->sum('jumlah') }}</span>
                                <span class="title" style="color: #00c853">Produk terjual hari ini</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric" style="border: 1px solid #ff9100">
                            <span class="icon" style="background-color: #ff9100"><i class="fa fa-shopping-bag"></i></span>
                            <p>
                                <span class="number" style="color: #ff9100">{{ $bulan_ini->sum('jumlah') }}</span>
                                <span class="title" style="color: #ff9100">Produk terjual bulan ini</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric" style="border: 1px solid #0081c2">
                            <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                            <p>
                                <span class="number" style="color: #0081c2">{{ $semua->sum('jumlah') }}</span>
                                <span class="title" style="color: #0081c2">Total produk terjual</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <h3 style="margin-bottom: 20px; font-size: 22px;">Transaksi Terbaru</h3>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Nama Pemesan</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Status Pesanan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($transaksi_terbaru as $p)
                                <tr style="background: rgb(250, 250, 250)">
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ date('d M Y', strtotime($p->created_at)) }}</td>
                                    @if ($p->jenis_pesanan == 'pesanan')
                                        <td>
                                            @if ($p->status == 'konfirmasi')
                                                <span class="label label-info">PEMBAYARAN</span>
                                            @elseif ($p->status == 'batal')
                                                <span class="label label-danger">DIBATALKAN</span>
                                            @elseif ($p->status == 'menunggu_validasi')
                                                <span class="label label-info">VALIDASI PEMBAYARAN</span>
                                            @elseif ($p->status == 'validasi')
                                                <span class="label label-info">PENGIRIMAN</span>
                                            @elseif ($p->status == 'validasi_invalid')
                                                <span class="label label-danger">PEMBAYARAN TIDAK VALID</span>
                                            @elseif ($p->status == 'pengiriman')
                                                <span class="label label-info">PENGIRIMAN</span>
                                            @elseif ($p->status == 'tiba_di_tujuan')
                                                <span class="label label-info">TIBA DI TUJUAN</span>
                                            @elseif ($p->status == 'selesai')
                                                <span class="label label-success">SELESAI</span>
                                            @endif
                                        </td>
                                    @else
                                        <td>
                                            @if ($p->status == 'konfirmasi')
                                                <span class="label label-info">PEMBAYARAN</span>
                                            @elseif ($p->status == 'batal')
                                                <span class="label label-danger">DIBATALKAN</span>
                                            @elseif ($p->status == 'menunggu_validasi')
                                                <span class="label label-info">VALIDASI PEMBAYARAN</span>
                                            @elseif ($p->status == 'validasi')
                                                <span class="label label-info">MENUNGGU STOK BARANG</span>
                                            @elseif ($p->status == 'validasi_invalid')
                                                <span class="label label-danger">PEMBAYARAN TIDAK VALID</span>
                                            @elseif ($p->status == 'stok_ready')
                                                <span class="label label-info">PENGIRIMAN</span>
                                            @elseif ($p->status == 'pengiriman')
                                                <span class="label label-info">PENGIRIMAN</span>
                                            @elseif ($p->status == 'tiba_di_tujuan')
                                                <span class="label label-info">TIBA DI TUJUAN</span>
                                            @elseif ($p->status == 'selesai')
                                                <span class="label label-success">SELESAI</span>
                                            @endif
                                        </td>
                                    @endif
                                    <td><button data-toggle="modal" data-target="#modal-detail-pesanan" data-idpesanan="{{ $p->id }}" style="border: none; background: transparent">
                                            <i class="far fa-info-circle" style="margin-right: 5px"></i>Detail Pesanan
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="/owner/semua-transaksi" style="float: right"><i class="fas fa-eye" style="margin-right: 5px"></i> Lihat semua transaksi ...</a>
                    </div>
                    <div class="col-md-3">
                        <div class="weekly-summary text-center" style="margin-top: 60px">
                            <span class="number">Rp {{ number_format($hari_ini->sum('total')) }}</span>
                            <span class="info-label">Pemasukan hari ini</span>
                        </div>
                        <div class="weekly-summary text-center">
                            <span class="number">Rp {{ number_format($bulan_ini->sum('total')) }}</span>
                            <span class="info-label">Pemasukan bulan ini</span>
                        </div>
                        <div class="weekly-summary text-center">
                            <span class="number">Rp {{ number_format($semua->sum('total')) }}</span>
                            <span class="info-label">Total pemasukan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Detail Pesanan --}}
        <div class="modal fade" id="modal-detail-pesanan" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div id="detail-pesanan-loader" style="text-align: center; margin-top:150px; margin-bottom: 150px; display: none">
                        <div class="loadingio-spinner-dual-ring-r5iq5osejl">
                            <div class="ldio-c34g0uje79h">
                                <div></div>
                                <div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="detail-pesanan-data">

                    </div>
                </div>
            </div>
        </div>

        <!-- Produk Teratas -->
        {{-- <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Produk Terlaris</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row" style="display: flex; margin-top: -15px; margin-bottom: 20px">
                            @foreach ($produk_terlaris as $pt)
                            <div class="col-sm-3 col-xs-6">
                                <div class="owner-produk">
                                    <img class="produk-teratas-img" src="{{ asset('user/barang_img/'.$pt->gambar) }}" alt="">
                                    <div class="owner-produk-text">
                                        <h5 style="font-size: 14px" title="{{ $pt->nama }}">{{ $pt->nama }}</h5>
                                    </div>
                                    <h5 style="font-size: 16px"><b>Rp {{ number_format($pt->harga) }}</b></h5>
                                    <h5 style="font-size: 13px">Terjual {{ $pt->terjual }} {{ $pt->jenis_stock }}</h5>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Paling Sering Dilihat</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row" style="display: flex; margin-top: -15px; margin-bottom: 20px">
                            @foreach ($sering_dilihat as $sd)
                                <div class="col-sm-3 col-xs-6">
                                    <div class="owner-produk">
                                        <img class="produk-teratas-img" src="{{ asset('user/barang_img/'.$sd->gambar) }}" alt="">
                                        <div class="owner-produk-text">
                                            <h5 style="font-size: 14px" title="{{ $sd->nama }}">{{ $sd->nama }}</h5>
                                        </div>
                                        <h5 style="font-size: 16px"><b>Rp {{ number_format($sd->harga) }}</b></h5>
                                        <h5 style="font-size: 13px">Dilihat {{ $sd->dilihat }} x</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Semua Produk -->
        <div class="row">
            <div class="panel panel-headline">
                <div class="panel-heading text-center">
                    <h3 class="panel-title" style="margin-top: 10px;">Semua Produk</h3>
                    <hr style="width: 200px; border: none; height: 3px; background-color: #999">
                    <div class="row" style="margin-top: 50px">
                        <div class="col-sm-12 col-lg-8">
                            <div class="produk-tools">
                                Filter Produk :
                                <span>
                                    <label class="fancy-radio">
                                        <input name="kategori" value="semua" type="radio" checked="checked">
                                        <span><i></i>Semua</span>
                                    </label>
                                    <label class="fancy-radio" style="margin-left: 10px;">
                                        <input name="kategori" value="makanan" type="radio">
                                        <span><i></i>Makanan hewan</span>
                                    </label>
                                    <label class="fancy-radio" style="margin-left: 10px;">
                                        <input name="kategori" value="obat" type="radio">
                                        <span><i></i>Obat - obatan</span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <div class="produk-tools-right">
                                <div class="input-group" style="width: 100%; margin-right: 10px">
                                    <span class="input-group-addon"><i id="search-icon" class="far fa-search"></i><i id="loading-search-icon" class="fas fa-spinner fa-spin" style="display: none"></i></span>
                                    <input id="cari-produk" class="form-control" placeholder="Cari Produk" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body" id="produk">
                    @include('owner.produk-data')
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
    <script>
        $('#modal-detail-pesanan').on('show.bs.modal', function(e){
            $('#detail-pesanan-data').empty();
            $('#detail-pesanan-loader').show()
            var button = $(e.relatedTarget);
            var id = button.data('idpesanan');
            $.ajax({
                type:'get',
                url:'/owner/detail-pesanan/'+id,
                success:function(data){
                    $('#detail-pesanan-loader').hide()
                    $('#detail-pesanan-data').html(data);
                }
            })
        })
    </script>
@endsection
