@extends('layouts.user_ui')
@section('content')
<head>
    <style>
        .form-title{
            margin-bottom: 5px;
            font-size: 13px
        }

        .checkout-left-basket{
            width: 75% !important;
        }

        .btn-bottom{
            width: 15%;
            margin-left: 5px;
            margin-right: 5px;
            padding-top: 9px;
            padding-bottom: 9px;
            border: none;
            border-radius: 5px;
            color: white;
            background: orange;
        }

        .btn-bottom:hover {
            background: rgb(255, 136, 0);
        }

        @media (max-width: 991px){
            .checkout-left-basket{
                width: 100% !important;
            }
        }

        @media (max-width: 700px){
            .btn-bottom{
                width: 35%;
            }
        }
    </style>
</head>

<div class="checkout">
    <div class="container">
        <h3 style="color: orange">Informasi Pesanan</h3>
        <form id="form-pesan" action="/pesanan-proses" method="POST">
            {{ csrf_field() }}
            <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="input-group" style="width: 100%">
                    <h5 class="form-title">Pemesan :</h5>
                    <input id="nama" type="text" name="nama" class="form-control" value="{{ Auth::user()->name }}">
                </div>
                <div class="input-group" style="width: 100%">
                    <h5 class="form-title">Nomor Telepon :</h5>
                    <input id="telp" type="text" name="telp" class="form-control" value="{{ Auth::user()->telp }}">
                    <span id="info-telp" style="font-size: 12px; color: #999"><i>* Nomor telepon yang bisa dihubungi</i></span>
                </div>
                <div class="input-group" style="width: 100%">
                    <h5 class="form-title">Alamat :</h5>
                    <input id="alamat" type="text" name="alamat" class="form-control" value="{{ Auth::user()->alamat }}">
                    <span id="info-alamat" style="font-size: 12px; color: #999"><i>* Alamat tujuan pengiriman</i></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="checkout-left-basket" data-wow-delay=".5s">
                    <br>
                    <ul>
                        @foreach (Auth::user()->keranjang as $k)
                        <li>{{ $k->nama }} &nbsp; x {{ $k->jumlah }} {{ $k->jenis_stock }}<span>Rp {{ number_format($k->total) }}</span></li>
                        @endforeach
                        <li><hr style="border: 1px solid rgb(201, 201, 201)"></li>
                        <li>Total <i class="far fa-info-circle" style="margin-left: 5px" data-toggle="tooltip" data-placement="right" title="Total harga belum termasuk ongkos kirim"></i>
                            <span>Rp {{ number_format($total) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="pembayaran" style="margin-left: 24%; margin-top: 20px">
                    <ul>
                        <li>
                            <h5 style="font-size: 12px; margin-bottom: 7px;">Ongkir ditentukan setelah pesanan dikonfirmasi oleh admin.</h5>
                        </li>
                        <li>
                            <h5 style="font-size: 12px; margin-bottom: 7px;">Lakukan pembayaran melalui transfer rekening bank.</h5>
                        </li>
                        <li>
                            <h5 style="font-size: 12px; margin-bottom: 7px;">Screenshot atau foto bukti pembayaran.</h5>
                        </li>
                        <li>
                            <h5 style="font-size: 12px; margin-bottom: 7px;">Upload bukti pembayaran, pastikan foto tidak buram.</h5>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
            <div class="row" style="margin-top: 50px;">
                <div style="text-align: center;">
                    <button id="btn-kembali" class="btn-bottom" type="button"><h5><i class="fas fa-chevron-left" style="margin-right: 10px"></i> Kembali</h5></button>
                    <button id="submit-pesan" class="btn-bottom" type="button"><h5>Lanjut <i class="fas fa-chevron-right" style="margin-left: 10px"></i></h5></button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

<script type="text/javascript" src="{{ asset('user/js/jquery-2.1.4.min.js') }}"></script>
<script>
    $(window).on('load', function(){
        $('#btn-kembali').on('click', function(){
            window.location = '/keranjang';
        });

        $('[data-toggle="tooltip"]').tooltip();

        $('#submit-pesan').on('click', function(){
            if($('#nama').val().length == 0){
                $('#nama').addClass('invalid');
            }else if($('#telp').val().length == 0){
                $('#telp').addClass('invalid');
            }else if($('#alamat').val().length == 0){
                $('#alamat').addClass('invalid');
            }else{
                $('#form-pesan').submit();
                $('#form-pesan').on('submit', function(e){
                    e.preventDefault();
                })
            }
        })
    })
</script>