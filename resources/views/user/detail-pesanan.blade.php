@extends('layouts.user_ui')
@section('content')

<div class="checkout">
    <div class="container">
        <h3 style="color: orange">Detail Pesanan</h3>
        <div class="pesanan-list">
            <div class="panel panel-default">
                <div class="panel-head-detail-pesanan">
                    <div class="col-xs-12">
                        <h5 style="font-size: 13px;">ID Pesanan, {{ $data->id }}</h5>
                        <h5 style="font-size: 13px; margin-top: 7px">Dikirim kepada, <b>{{ $data->nama }}</b></h5>
                        <h5 style="font-size: 13px; margin-top: 7px">{{ $data->alamat }}</h5>
                        <h5 style="font-size: 13px; margin-top: 7px">Telp : {{ $data->telp }}</h5>
                        <hr class="panel-head-hr">
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12 col-md-8 barang">
                        <hr class="barang-hr">
                        @foreach ($data->pesananbarang as $pb)
                        <div class="col-xs-12 col-sm-6">
                            <div class="pesanan-item">
                                <img src="{{ asset('user/barang_img/'.$pb->gambar) }}" width="70px" height="70px" alt="">
                                <ul style="list-style-type: none">
                                    <li><h5 style="font-size: 13px; margin-left: 10px"><b>{{ $pb->nama }}</b></h5></li>
                                    <li><h5 style="font-size: 12px; margin-left: 10px; margin-top: 10px">Rp {{ number_format($pb->harga) }}</h5></li>
                                    <li><h5 style="font-size: 12px; margin-left: 10px; margin-top: 10px">{{ $pb->jumlah }} {{ $pb->jenis_stock }}</h5></li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-xs-12 col-md-4 detail-harga">
                        <hr class="detail-harga-hr">
                        <ul style="list-style-type: none; margin-bottom: 20px" id="detail-harga-barang">
                            @foreach ($data->pesananbarang as $pb)
                            <li style="margin-bottom: 10px">
                                <h5 style="font-size: 13px"><b>{{ $pb->nama }}</b> x {{ $pb->jumlah }}<span style="float: right">Rp {{ number_format($pb->total) }}</span></h5>
                            </li>
                            @endforeach
                            <li style="margin-bottom: 10px">
                                @if ($data->ongkir == null)
                                    <h5 style="font-size: 13px">
                                        <b>Ongkir</b>
                                        <i class="far fa-info-circle" style="margin-left: 5px" data-toggle="tooltip" data-placement="right" title="Ditentukan saat pesanan dikonfirmasi oleh admin"></i>
                                        <span style="float: right">-</span>
                                    </h5>
                                @else
                                    <h5 style="font-size: 13px">
                                        <b>Ongkir</b>
                                        <span style="float: right">Rp {{ number_format($data->ongkir) }}</span>
                                    </h5>
                                @endif
                            </li>
                        </ul>
                        <div class="detail-pesanan-harga">
                            <h5>Total Belanja</h5>
                            <br>
                            <h4 id="total-belanja"><b>Rp {{ number_format($data->total) }}</b></h4>
                        </div>
                    </div>
                    <div class="col-xs-12 status-pesanan">
                        <hr class="status-pesanan-hr">
                        <h4 style="text-align: center; color: orange; margin-top: 50px; margin-bottom: 30px;">STATUS PESANAN</h4>
                        <div id="status-pesanan-{{ $data->id }}">
                            @include('user.status-pesanan')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Upload Bukti Pembayaran --}}
<div class="modal fade" id="bukti-pembayaran-upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog-bukti-pembayaran" role="document">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
            </div>
            <form id="form-bukti-pembayaran" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="pembayaran">
                    <ul>
                        <li>
                            <h5 style="font-size: 12px; margin-bottom: 7px; margin-left: 7px;">Lakukan pembayaran transfer melalui rekening bank.</h5>
                        </li>
                        <li>
                            <h5 style="font-size: 12px; margin-bottom: 7px; margin-left: 7px;">Bank BCA</h5>
                            <h5 style="font-size: 12px; margin-bottom: 7px; margin-left: 7px;">No. Rekening 8850827118</h5>
                            <h5 style="font-size: 12px; margin-bottom: 7px; margin-left: 7px;">A/N Dicky Wahyudi</h5>
                        </li>
                        <li>
                            <h5 style="font-size: 12px; margin-bottom: 7px; margin-left: 7px;">Screenshot atau foto bukti pembayaran.</h5>
                        </li>
                        <li>
                            <h5 style="font-size: 12px; margin-bottom: 7px; margin-left: 7px;">Upload bukti pembayaran, pastikan foto tidak buram.</h5>
                        </li>
                    </ul>
                </div>
                <img id="preview-bukti-pembayaran" src="" class="" width="100%" alt="">
                <div class="" style="text-align: center">
                    <span id="foto-bukti-pembayaran-invalid" class="helper-text" style="color: red; margin-top: 17px; display: none"><i>Pilih foto sebelum upload</i></span>
                    <button type="button" class="btn-pembayaran" style="margin-top: 10px" onclick="document.getElementById('bukti-pembayaran-input').click()">Pilih Foto</button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input id="id-pesanan" type="hidden" name="id_pesanan" value="{{ $data->id }}">
                    <input id="bukti-pembayaran-input" type="file" name="bukti_pembayaran" style="display: none">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-upload-pembayaran">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal View Bukti Pembayaran --}}
<div class="modal fade" id="view-bukti-pembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog-bukti-pembayaran" role="document">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
            </div>
            <div class="modal-body">
                <img id="view-bukti-pembayaran" src="" class="" width="100%" alt="">
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $('#bukti-pembayaran-upload').on('show.bs.modal', function(){
        $('#preview-bukti-pembayaran').attr('src', '{{ asset("user/barang_img/no_image.png") }}');
        $('#bukti-pembayaran-input').val('');
    })

    $('[data-toggle="tooltip"]').tooltip();

    var bukti_pembayaran_input = document.querySelector('#bukti-pembayaran-input');
    bukti_pembayaran_input.addEventListener('change', foto_preview);
    function foto_preview(){
        var fileObject = this.files[0];
        var fileReader = new FileReader();
        fileReader.readAsDataURL(fileObject);
        fileReader.onload = function(){
            var result = fileReader.result;
            var img = document.querySelector('#preview-bukti-pembayaran');
            img.setAttribute('src', result);
        }
    }
</script>
    
@endsection