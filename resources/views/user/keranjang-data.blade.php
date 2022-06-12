
@if (Auth::user()->keranjang->count() > 0)
<div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
    <table class="timetable_sub">
        <thead>
            <tr>
                <th>Hapus</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Auth::user()->keranjang as $k)
                <tr>
                    <td><i class="far fa-trash-alt delete-from-cart" data-idkeranjang="{{ $k->id }}"></i></td>
                    <td>
                        <a href="{{ $k->url }}"><img src="{{ asset('user/barang_img/'.$k->gambar) }}" class="keranjang-gambar-produk"></a>
                        <h5 style="color: rgb(255, 145, 0)">{{ $k->nama }}</h5>
                    </td>
                    <td>Rp {{ number_format($k->harga) }}</td>
                    <td>
                        <div class="quantity">
                            <div class="quantity-select">
                                <div data-idkeranjang="{{ $k->id }}" class="entry value-minus">&nbsp;</div>
                                <div id="{{ $k->id }}" class="entry value"><span>{{ $k->jumlah }}</span></div>
                                <div data-idkeranjang="{{ $k->id }}" class="entry value-plus active">&nbsp;</div>
                            </div>
                        </div>
                    </td>
                    <td>Rp {{ number_format($k->total) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="checkout-left">
    <div class="checkout-right-basket" data-wow-delay=".5s">
        <a href="/"><i class="fas fa-chevron-left" style="margin-right: 10px"></i>Lanjut Belanja</a>
    </div>
    <div class="checkout-left-basket" data-wow-delay=".5s">
        <br>
        <ul>
            <li>Total <i class="far fa-info-circle" style="margin-left: 5px" data-toggle="tooltip" data-placement="right" title="Total harga sudah termasuk ongkos kirim"></i>
                <span>Rp {{ number_format($total) }}</span>
            </li>
            <li class="lanjut-bayar"><h5>Lanjut Pesanan <i class="fas fa-chevron-right" style="margin-left: 10px"></i></h5></li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
@else
<div style="text-align: center; color: #999 !important; margin-top: 150px; margin-bottom: 100px">
    <i class="fal fa-shopping-cart" style="font-size: 80px;"></i>
    <br><br>
    <h5>Keranjang belanja kamu masih kosong.</h5>
    <br>
    <button class="btn-belanja"><h5><i class="far fa-shopping-bag" style="margin-right: 5px"></i> Belanja sekarang</h5></button>
</div>
@endif
