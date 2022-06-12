@foreach ($pesanan as $p)
    <tr style="background: rgb(250, 250, 250)">
        <td>{{ $p->id }}</td>
        <td>{{ $p->nama }}</td>
        <td>{{ date('d M Y', strtotime($p->created_at)) }}</td>
        <td>Rp {{ number_format($p->total) }}</td>
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