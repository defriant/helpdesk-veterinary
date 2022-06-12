@php
    function waktu_lalu($timestamp){ // membuat fungsi menghitung waktu
        $selisih = time() - strtotime($timestamp) ;
        $detik = $selisih ;
        $menit = round($selisih / 60 );
        $jam = round($selisih / 3600 );
        $hari = round($selisih / 86400 );
        $minggu = round($selisih / 604800 );
        $bulan = round($selisih / 2419200 );
        $tahun = round($selisih / 29030400 );
        if ($detik <= 60) {
            $waktu = $detik.' Detik yang lalu';
        } else if ($menit <= 60) {
            $waktu = $menit.' Menit yang lalu';
        } else if ($jam <= 24) {
            $waktu = $jam.' Jam yang lalu';
        } else if ($hari <= 7) {
            $waktu = $hari.' Hari yang lalu';
        } else if ($minggu <= 4) {
            $waktu = $minggu.' Minggu yang lalu';
        } else {
            $waktu = date("d M Y", strtotime($timestamp));
        }
        return $waktu;
    }
@endphp
@if (Auth::user()->notifikasi->count() > 0)
    @foreach (Auth::user()->notifikasi->sortByDesc('created_at') as $notif)
        @if ($notif->is_read == 0)
            <div class="notif-item" onclick="notif_link('{{ $notif->url}}')">
                <div class="kategori">
                    <h6>
                        @if ($notif->jenis == 'pesanan')
                        <i class="far fa-shopping-bag" style="color: coral"></i>&nbsp; Pesanan
                        @elseif($notif->jenis == 'pembayaran')
                        <i class="far fa-sack-dollar" style="color: green"></i>&nbsp; Pembayaran
                        @endif
                        <span class="notif-tgl"><i class="fas fa-circle" style="font-size: 5px; position: relative; bottom: 2px;"></i>&nbsp; {{ waktu_lalu($notif->created_at) }}</span>
                    </h6>
                    <p class="teks">{{ $notif->notif }}</p>
                </div>
            </div>
        @else
            <div class="notif-item" style="background: rgb(248, 248, 248)" onclick="notif_link('{{ $notif->url}}')">
                <div class="kategori">
                    <h6>
                        @if ($notif->jenis == 'pesanan')
                        <i class="far fa-shopping-bag" style="color: coral"></i>&nbsp; Pesanan
                        @elseif($notif->jenis == 'pembayaran')
                        <i class="far fa-sack-dollar" style="color: green"></i>&nbsp; Pembayaran
                        @endif
                        <span class="notif-tgl"><i class="fas fa-circle" style="font-size: 5px; position: relative; bottom: 2px;"></i>&nbsp; {{ waktu_lalu($notif->created_at) }}</span>
                    </h6>
                    <p class="teks">{{ $notif->notif }}</p>
                </div>
            </div>
        @endif
    @endforeach
@else
<div style="text-align: center; margin-top: 50px; margin-bottom: 50px"><i class="far fa-bell" style="font-size: 50px; opacity: .3"></i> </div>
@endif