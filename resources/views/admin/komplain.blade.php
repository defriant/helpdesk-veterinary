@extends('layouts.admin_ui')
@section('content')

<div class="main-content">
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading no-print" style="padding-bottom: 0">
                <div class="row">
                    <div class="col-sm-12 col-lg-8">
                        <h4 class="pesanan-title"><b><span style="color: #00AAFF">LAPORAN PENGADUAN</span></b></h4>
                    </div>
                </div>

                <hr>
            </div>
            <div class="panel-body" id="data-komplain">
                <div class="loader">
                    <div class="loader4"></div>
                    <h5 style="margin-top: 2.5rem">Loading data</h5>
                </div>
            </div>
        </div>
        <!-- END OVERVIEW -->
    </div>
</div>

@endsection
