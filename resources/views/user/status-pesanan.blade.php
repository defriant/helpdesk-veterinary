
@if ($data->status == 'menunggu_konfirmasi')

<div class="status-pesanan-list">
    <i class="far fa-spinner fa-pulse icon-bg-color status-pesanan-icon-process"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-process"><b>MENUNGGU KONFIRMASI PESANAN</b></h5>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->created_at)) }}</h5>
            <h5 style="font-size: 12px">Pesananmu sudah dikirim ke admin untuk dikonfirmasi ketersediaan barang.</h5>
        </div>
    </div>
</div>

@elseif($data->status == 'batal')

<div class="status-pesanan-list">
    <i class="far fa-times icon-bg-color status-pesanan-icon-batal"></i>
    <div class="status-pesanan-item" style="border: none">
        <h5 class="status-pesanan-batal"><b>DIBATALKAN</b></h5>
        <div class="status-pesanan-item-validasi-invalid">
            <h5 style="font-size: 12px; margin-bottom: 7px">Pesananmu dibatalkan oleh admin.</h5>
            <h5 style="font-size: 12px">Note : {{ $data->alasan_batal }}</h5>
        </div>
    </div>
</div>

@elseif($data->status == 'konfirmasi')
    
    <div class="status-pesanan-list">
        <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
        <div class="status-pesanan-item">
            <h5 class="status-pesanan-done"><b>MENUNGGU KONFIRMASI PESANAN</b></h5>
            <div class="status-pesanan-item-process">
                <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->created_at)) }}</h5>
                <h5 style="font-size: 12px">Pesananmu sudah dikirim ke admin untuk dikonfirmasi ketersediaan barang.</h5>
            </div>
            <div class="status-pesanan-item-done">
                <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->konfirmasi)) }}</h5>
                <h5 style="font-size: 12px">Pesanan dikonfirmasi.</h5>
            </div>
        </div>
    </div>

    <div class="status-pesanan-list" style="margin-top: -25px">
        <i class="far fa-spinner fa-pulse icon-bg-color status-pesanan-icon-process"></i>
        <div class="status-pesanan-item">
            <h5 class="status-pesanan-process"><b>PEMBAYARAN</b></h5>
            <div class="status-pesanan-item-btn">
                <button type="button" class="btn-pembayaran" data-toggle="modal" data-target="#bukti-pembayaran-upload"><h5 style="font-size: 12px">Upload Bukti Pembayaran</h5></button>
            </div>
        </div>
    </div>

@elseif($data->status == 'menunggu_validasi')

<div class="status-pesanan-list">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>MENUNGGU KONFIRMASI PESANAN</b></h5>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->created_at)) }}</h5>
            <h5 style="font-size: 12px">Pesananmu sudah dikirim ke admin untuk dikonfirmasi ketersediaan barang.</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->konfirmasi)) }}</h5>
            <h5 style="font-size: 12px">Pesanan dikonfirmasi.</h5>
        </div>
    </div>
</div>

<div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-spinner fa-pulse icon-bg-color status-pesanan-icon-process"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-process"><b>PEMBAYARAN</b></h5>
        <div class="status-pesanan-item-btn">
            <button type="button" class="btn-pembayaran" data-view="{{ asset('user/bukti_pembayaran/'.$data->bukti_pembayaran) }}"
                data-toggle="modal" data-target="#view-bukti-pembayaran"><h5 style="font-size: 12px">Bukti Pembayaran</h5>
            </button>
        </div>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->menunggu_validasi)) }}</h5>
            <h5 style="font-size: 12px">Menunggu validasi pembayaran.</h5>
        </div>
    </div>
</div>

@elseif($data->status == 'validasi_invalid')

<div class="status-pesanan-list">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>MENUNGGU KONFIRMASI PESANAN</b></h5>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->created_at)) }}</h5>
            <h5 style="font-size: 12px">Pesananmu sudah dikirim ke admin untuk dikonfirmasi ketersediaan barang.</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->konfirmasi)) }}</h5>
            <h5 style="font-size: 12px">Pesanan dikonfirmasi.</h5>
        </div>
    </div>
</div>

<div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-spinner fa-pulse icon-bg-color status-pesanan-icon-process"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-process"><b>PEMBAYARAN</b></h5>
        <div class="status-pesanan-item-btn">
            <button type="button" class="btn-pembayaran" data-toggle="modal" data-target="#bukti-pembayaran-upload"><h5 style="font-size: 12px">Upload Ulang Bukti Pembayaran</h5></button>
        </div>
        <div class="status-pesanan-item-validasi-invalid">
            <h5 style="font-size: 12px">Bukti pembayaran anda tidak valid, silahkan upload ulang.</h5>
        </div>
    </div>
</div>

@elseif($data->status == 'validasi')

<div class="status-pesanan-list">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>MENUNGGU KONFIRMASI PESANAN</b></h5>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->created_at)) }}</h5>
            <h5 style="font-size: 12px">Pesananmu sudah dikirim ke admin untuk dikonfirmasi ketersediaan barang.</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->konfirmasi)) }}</h5>
            <h5 style="font-size: 12px">Pesanan dikonfirmasi.</h5>
        </div>
    </div>
</div>

<div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>PEMBAYARAN</b></h5>
        <div class="status-pesanan-item-btn">
            <button type="button" class="btn-pembayaran" data-view="{{ asset('user/bukti_pembayaran/'.$data->bukti_pembayaran) }}"
                data-toggle="modal" data-target="#view-bukti-pembayaran"><h5 style="font-size: 12px">Bukti Pembayaran</h5>
            </button>
        </div>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->menunggu_validasi)) }}</h5>
            <h5 style="font-size: 12px">Menunggu validasi pembayaran.</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->validasi)) }}</h5>
            <h5 style="font-size: 12px">Pembayaran telah divalidasi oleh admin.</h5>
        </div>
    </div>
</div>

<div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-spinner fa-pulse icon-bg-color status-pesanan-icon-process"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-process"><b>PENGIRIMAN PESANAN</b></h5>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 12px">Menunggu kurir</h5>
        </div>
    </div>
</div>

@elseif($data->status == 'pengiriman')

<div class="status-pesanan-list">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>MENUNGGU KONFIRMASI PESANAN</b></h5>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->created_at)) }}</h5>
            <h5 style="font-size: 12px">Pesananmu sudah dikirim ke admin untuk dikonfirmasi ketersediaan barang.</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->konfirmasi)) }}</h5>
            <h5 style="font-size: 12px">Pesanan dikonfirmasi.</h5>
        </div>
    </div>
</div>

<div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>PEMBAYARAN</b></h5>
        <div class="status-pesanan-item-btn">
            <button type="button" class="btn-pembayaran" data-view="{{ asset('user/bukti_pembayaran/'.$data->bukti_pembayaran) }}"
                data-toggle="modal" data-target="#view-bukti-pembayaran"><h5 style="font-size: 12px">Bukti Pembayaran</h5>
            </button>
        </div>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->menunggu_validasi)) }}</h5>
            <h5 style="font-size: 12px">Menunggu validasi pembayaran.</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->validasi)) }}</h5>
            <h5 style="font-size: 12px">Pembayaran telah divalidasi oleh admin.</h5>
        </div>
    </div>
</div>

<div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-spinner fa-pulse icon-bg-color status-pesanan-icon-process"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-process"><b>PENGIRIMAN PESANAN</b></h5>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 12px">Menunggu kurir</h5>
        </div>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->pengiriman)) }}</h5>
            <h5 style="font-size: 12px">Pesanan sedang diantar ke {{ $data->alamat }}</h5>
        </div>
    </div>
</div>

@elseif($data->status == 'tiba_di_tujuan')

<div class="status-pesanan-list">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>MENUNGGU KONFIRMASI PESANAN</b></h5>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->created_at)) }}</h5>
            <h5 style="font-size: 12px">Pesananmu sudah dikirim ke admin untuk dikonfirmasi ketersediaan barang.</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->konfirmasi)) }}</h5>
            <h5 style="font-size: 12px">Pesanan dikonfirmasi.</h5>
        </div>
    </div>
</div>

<div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>PEMBAYARAN</b></h5>
        <div class="status-pesanan-item-btn">
            <button type="button" class="btn-pembayaran" data-view="{{ asset('user/bukti_pembayaran/'.$data->bukti_pembayaran) }}"
                data-toggle="modal" data-target="#view-bukti-pembayaran"><h5 style="font-size: 12px">Bukti Pembayaran</h5>
            </button>
        </div>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->menunggu_validasi)) }}</h5>
            <h5 style="font-size: 12px">Menunggu validasi pembayaran.</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->validasi)) }}</h5>
            <h5 style="font-size: 12px">Pembayaran telah divalidasi oleh admin.</h5>
        </div>
    </div>
</div>

<div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>PENGIRIMAN PESANAN</b></h5>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 12px">Menunggu kurir</h5>
        </div>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->pengiriman)) }}</h5>
            <h5 style="font-size: 12px">Pesanan sedang diantar ke {{ $data->alamat }}</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->tiba_di_tujuan)) }}</h5>
            <h5 style="font-size: 12px">Pesanan tiba ditujuan</h5>
        </div>
    </div>
</div>

{{-- <div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-spinner fa-pulse icon-bg-color status-pesanan-icon-process"></i>
    <div class="status-pesanan-item" style="border: none">
        <h5 class="status-pesanan-process"><b>PESANAN SELESAI</b></h5>
        <div class="status-pesanan-item-btn">
            <button type="button" onclick="pesanan_selesai({{$data->id}})" class="btn-pembayaran"><h5 style="font-size: 12px">Konfirmasi Pesanan Telah Selesai</h5></button>
        </div>
    </div>
</div> --}}

@elseif($data->status == 'selesai')

<div class="status-pesanan-list">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>MENUNGGU KONFIRMASI PESANAN</b></h5>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->created_at)) }}</h5>
            <h5 style="font-size: 12px">Pesananmu sudah dikirim ke admin untuk dikonfirmasi ketersediaan barang.</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->konfirmasi)) }}</h5>
            <h5 style="font-size: 12px">Pesanan dikonfirmasi.</h5>
        </div>
    </div>
</div>

<div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>PEMBAYARAN</b></h5>
        <div class="status-pesanan-item-btn">
            <button type="button" class="btn-pembayaran" data-view="{{ asset('user/bukti_pembayaran/'.$data->bukti_pembayaran) }}"
                data-toggle="modal" data-target="#view-bukti-pembayaran"><h5 style="font-size: 12px">Bukti Pembayaran</h5>
            </button>
        </div>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->menunggu_validasi)) }}</h5>
            <h5 style="font-size: 12px">Menunggu validasi pembayaran.</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->validasi)) }}</h5>
            <h5 style="font-size: 12px">Pembayaran telah divalidasi oleh admin.</h5>
        </div>
    </div>
</div>

<div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item">
        <h5 class="status-pesanan-done"><b>PENGIRIMAN PESANAN</b></h5>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 12px">Menunggu kurir</h5>
        </div>
        <div class="status-pesanan-item-process">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->pengiriman)) }}</h5>
            <h5 style="font-size: 12px">Pesanan sedang diantar ke {{ $data->alamat }}</h5>
        </div>
        <div class="status-pesanan-item-done">
            <h5 style="font-size: 11px; margin-bottom: 7px">{{ date("d M Y H:i", strtotime($data->tiba_di_tujuan)) }}</h5>
            <h5 style="font-size: 12px">Pesanan tiba ditujuan</h5>
        </div>
    </div>
</div>

<div class="status-pesanan-list" style="margin-top: -25px">
    <i class="far fa-check icon-bg-color status-pesanan-icon-done"></i>
    <div class="status-pesanan-item" style="border: none">
        <h5 class="status-pesanan-done"><b>PESANAN SELESAI</b></h5>
    </div>
</div>

@endif