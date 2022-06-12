@foreach ($data as $d)
    @if ($d->stock <= 0)
        <div class="col-md-3 product-men yes-marg">
            <div class="men-pro-item simpleCart_shelfItem" id="zoom-in">
                
                <div class="thumb-item">
                    <a href="/produk/{{ $d->id }}" onclick="return view_produk('/produk/{{ $d->id }}')"><img src="{{ asset('user/barang_img/'.$d->gambar) }}" height="235px" class="pro-image-front" style="opacity: 0.5"></a> 
                </div>
                <div class="out-of-stock">
                    <div class="" style="text-align: center">
                        <span>STOK HABIS</span>
                    </div>
                </div>
                <div class="item-info-product">
                    <h4><a href="/produk/{{ $d->id }}" onclick="return view_produk('/produk/{{ $d->id }}')" title="{{ $d->nama }}">{{ $d->nama }}</a></h4>
                    <div class="info-product-price">
                        <span class="item_price">Rp {{ number_format($d->harga) }}</span>
                    </div>
                    <h5 style="padding: 3px 14px; margin-bottom: 7px"><i>Stok sedang habis</i></h5>						
                </div>
            </div>
        </div>
    @else
        <div class="col-md-3 product-men yes-marg">
            <div class="men-pro-item simpleCart_shelfItem" id="zoom-in">
                {{-- <span class="product-new-top">{{ $d->jenis }}</span> --}}
                <div class="thumb-item">
                    <a href="/produk/{{ $d->id }}" onclick="return view_produk('/produk/{{ $d->id }}')"><img src="{{ asset('user/barang_img/'.$d->gambar) }}" height="235px" class="pro-image-front"></a>
                    
                </div>
                <div class="item-info-product ">
                    <h4><a href="/produk/{{ $d->id }}" onclick="return view_produk('/produk/{{ $d->id }}')" title="{{ $d->nama }}">{{ $d->nama }}</a></h4>
                    <div class="info-product-price">
                        <span class="item_price">Rp {{ number_format($d->harga) }}</span>
                    </div>
                    <p style="color: #999; margin: 1rem 0">Stok tersisa {{ $d->stock }}</p>
                    @guest
                        <a href="#" class="item_add single-item hvr-outline-out button2" data-toggle="modal" data-target="#myModal4">Add to cart</a>
                    @endguest

                    @auth
                        <a data-idproduk="{{ $d->id }}" data-jumlah="1" class="item_add single-item hvr-outline-out button2 tambah-keranjang" style="cursor: pointer">Add to cart</a>		
                    @endauth					
                </div>
            </div>
        </div>
    @endif
@endforeach