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
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Steve</td>
                            <td>Jobs</td>
                            <td>@steve</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Simon</td>
                            <td>Philips</td>
                            <td>@simon</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Jane</td>
                            <td>Doe</td>
                            <td>@jane</td>
                        </tr>
                    </tbody>
                </table>
                {{-- <button class="no-print" id="btn-print"><i class="far fa-print"></i> &nbsp; Print</button>
                <div id="laporan-transaksi-content">
                    <div class="loader">
                        <i class="fas fa-ban" style="font-size: 5rem; opacity: .5"></i>
                        <h5 style="margin-top: 2.5rem; opacity: .75">Pilih periode transaksi untuk melihat laporan</h5>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- END OVERVIEW -->
    </div>
</div>

@endsection
