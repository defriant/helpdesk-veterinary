@extends('layouts.admin_ui')
@section('content')

<div class="main-content">
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-12 col-lg-8" style="display: flex">
                        <a href="/owner" class="header-link"><i class="fas fa-chevron-circle-left"></i></a>
                        <h4 class="pesanan-title"><b><span style="color: #00AAFF">SEMUA TRANSAKSI</span></b></h4>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="produk-tools-right">
                            <div class="input-group" style="width: 100%; margin-right: 10px">
                                <span class="input-group-addon"><i id="search-icon" class="far fa-search"></i><i id="loading-search-icon" class="fas fa-spinner fa-spin" style="display: none"></i></span>
                                <input id="cari-pesanan" class="form-control" placeholder="Cari Transaksi Berdasarkan ID ..." type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Nama Pemesan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Total Belanja</th>
                            <th>Status Pesanan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="semua-transaksi-data">
                        @include('admin.semua-transaksi-data')
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END OVERVIEW -->
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

        $('#cari-pesanan').on('input', function(){
            if ($('#cari-pesanan').val().length == 0) {
                pesanan_data();
            }else if ($('#cari-pesanan').val().length % 3 == 0) {
                $('#search-icon').hide();
                $('#loading-search-icon').show();
                var id = $('#cari-pesanan').val()
                $.ajax({
                    type:'get',
                    url:'/owner/cari-pesanan/'+id,
                    success:function(data){
                        $('#loading-search-icon').hide();
                        $('#search-icon').show();
                        $('#semua-transaksi-data').html(data);
                    }
                })
            }
        })

        function pesanan_data(){
            $.ajax({
                type:'get',
                url:'/owner/semua-transaksi-data',
                success:function(data){
                    $('#loading-search-icon').hide();
                    $('#search-icon').show();
                    $('#semua-transaksi-data').html(data);
                }
            })
        }
    </script>
@endsection
