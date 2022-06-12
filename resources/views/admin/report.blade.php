@extends('layouts.admin_ui')
@section('content')

<div class="main-content">
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading no-print" style="padding-bottom: 0">
                <div class="row">
                    <div class="col-sm-12 col-lg-8">
                        <h4 class="pesanan-title"><b><span style="color: #00AAFF">LAPORAN TRANSAKSI</span></b></h4>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="produk-tools-right">
                            <div class="input-group" style="width: 100%; margin-right: 10px">
                                <input class="form-control month-picker" type="text" id="search-month" placeholder="Periode transaksi" readonly>
                                <span class="input-group-btn"><button id="btn-search-report" class="btn btn-primary" type="button" style="padding: 6px 12px; background: #00AAFF; border: 1px solid #00AAFF"><i class="fas fa-search"></i></button></span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
            </div>
            <div class="panel-body" id="printarea">
                <button class="no-print" id="btn-print"><i class="far fa-print"></i> &nbsp; Print</button>
                <div id="laporan-transaksi-content">
                    <div class="loader">
                        <i class="fas fa-ban" style="font-size: 5rem; opacity: .5"></i>
                        <h5 style="margin-top: 2.5rem; opacity: .75">Pilih periode transaksi untuk melihat laporan</h5>
                    </div>
                </div>
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
