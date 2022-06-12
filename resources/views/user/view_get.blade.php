@extends('layouts.user_ui')
@section('content')

<div class="top-kategori">
    <button data-kategori="all" class="btn-kategori active"><h5 style="font-size: 16px">Semua Produk</b></h5></button>
    <button data-kategori="makanan" class="btn-kategori"><h5 style="font-size: 16px">Makanan Hewan</b></h5></button>
    <button data-kategori="obat" class="btn-kategori"><h5 style="font-size: 16px">Obat obatan</b></h5></button>
</div>
<div class="product-easy">
    <div class="container">

        <div class="sap_tabs">
            <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                <div class="title-kategori" style="display: none">
                    <h3 style="color: #999"><b>Semua Produk</b></h3>
                    <hr>
                </div>
                <div class="resp-tabs-container">
                    <div id="product-loader"
                        style="text-align: center; margin-top:150px; margin-bottom: 150px; display:none">
                        <div class="loadingio-spinner-dual-ring-r5iq5osejl">
                            <div class="ldio-c34g0uje79h">
                                <div></div>
                                <div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="product-data">

                        <div class="single">
                            <div class="container">
                                {{-- <div class="col-md-6 single-right-left animated wow slideInUp animated" data-wow-delay=".5s"
                                    style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
                                    <div class="thumb-image"> <img src="{{ asset('user/barang_img/'.$data->gambar) }}"
                                data-imagezoom="true"
                                class="img-responsive" width="450px" style="border: 1px solid rgb(185, 185, 185)">
                            </div>
                        </div> --}}
                        <div class="col-md-6 single-right-left animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
                            <div class="grid images_3_of_2">
                                <div class="flexslider">
                                    <!-- FlexSlider -->
                                        <script>
                                        // Can also be used with $(document).ready()
                                            $(window).load(function() {
                                                $('.flexslider').flexslider({
                                                animation: "slide",
                                                controlNav: "thumbnails"
                                                });
                                            });
                                        </script>
                                    <!-- //FlexSlider-->
                                    <ul class="slides">
                                        <li data-thumb="{{ asset('user/barang_img/' . $data->barangimg[0]->gambar) }}">
                                            <div class="thumb-image"> <img src="{{ asset('user/barang_img/' . $data->barangimg[0]->gambar) }}" data-imagezoom="true" class="img-responsive"> </div>
                                        </li>
                                        <li data-thumb="{{ asset('user/barang_img/' . $data->barangimg[1]->gambar) }}">
                                            <div class="thumb-image"> <img src="{{ asset('user/barang_img/' . $data->barangimg[1]->gambar) }}" data-imagezoom="true" class="img-responsive"> </div>
                                        </li>	
                                        <li data-thumb="{{ asset('user/barang_img/' . $data->barangimg[2]->gambar) }}">
                                            <div class="thumb-image"> <img src="{{ asset('user/barang_img/' . $data->barangimg[2]->gambar) }}" data-imagezoom="true" class="img-responsive"> </div>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>	
                            </div>
                        </div>
                        <div class="col-md-6 single-right-left simpleCart_shelfItem animated wow slideInRight animated"
                            data-wow-delay=".5s"
                            style="visibility: visible; animation-delay: 0.5s; animation-name: slideInRight;">
                            <h3>{{ $data->nama }}</h3>
                            <p><span class="item_price">Rp {{ number_format($data->harga) }}</span></p>
                            <div class="rating1">
                                @if ($data->stock > 0)
                                <span class="stock">READY STOCK</span>
                                <span style="font-size: 15px; padding-left: 7px;">{{ $data->stock }} Unit</span>
                                <input type="hidden" id="stok-produk" value="{{ $data->stock }}">
                                @else
                                <span class="no-stock">STOK HABIS</span>
                                @endif
                            </div>
                            <div class="occasional">
                                @if ($data->jenis == 'kitchen_set')
                                <h5>Kategori : Kitchen Set</h5>
                                @elseif($data->jenis == 'tempat_tidur')
                                <h5>Kategori : Tempat Tidur</h5>
                                @elseif($data->jenis == 'lemari')
                                <h5>Kategori : Lemari</h5>
                                @elseif($data->jenis == 'meja')
                                <h5>Kategori : Meja</h5>
                                @elseif($data->jenis == 'kursi')
                                <h5>Kategori : kursi</h5>
                                @endif
                            </div>
                            <div class="color-quality">
                                <div class="color-quality-right">
                                    <h5>Jumlah :</h5>
                                    <div class="quantity">
                                        <button id="jumlah-kurang" type="button" class="btn-jumlah"><i
                                                class="far fa-minus"></i></button>
                                        <input id="jumlah" type="text" name="jumlah" value="1" class="jumlah"
                                            required="">
                                        <button id="jumlah-tambah" type="button" class="btn-jumlah"><i
                                                class="far fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="occasional">

                            </div>
                            <div class="occasion-cart">
                                @if ($data->stock > 0)
                                @guest
                                <a class="item_add hvr-outline-out button2" data-toggle="modal" data-target="#myModal4"
                                    style="cursor: pointer"><i class="far fa-plus"></i>&nbsp;&nbsp; Keranjang</a>
                                @endguest
                                @auth
                                <a id="tambah-keranjang" data-idproduk="{{ $data->id }}"
                                    class="item_add hvr-outline-out button2" style="cursor: pointer"><i
                                        class="far fa-plus"></i>&nbsp;&nbsp; Keranjang</a>
                                @endauth
                                @else
                                <h6 style="font-size: 15px"><i>Stock barang ini sedang habis, silahkan di cek kembali
                                        nanti</i></h6>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"> </div>

                        <div class="bootstrap-tab animated wow slideInUp animated" data-wow-delay=".5s"
                            style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
                            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home"
                                        aria-labelledby="home-tab">
                                        <h5>DESKRIPSI PRODUK</h5>
                                        <div class="row" style="margin-top: -30px">
                                            <div class="col-sm-12 col-lg-8">
                                                <p style="white-space: pre-line">
                                                    {{ $data->deskripsi }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</div>
</div>

@endsection
