@extends('layouts.admin_ui')
@section('content')

<div class="main-content">
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h4 class="pesanan-title"><b>PESANAN / <span style="color: #00AAFF">KONFIRMASI TIBA DI TUJUAN</span></b></h4>
            </div>
            <div class="panel-body" style="margin-top: 20px">
                <div class="row">
                    <div class="pesanan-list">
                        <div id="tiba-di-tujuan-data">
                            @include('admin.pesanan.tiba-di-tujuan-data')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OVERVIEW -->
    </div>
</div>

@endsection

@section('scripts')

<script>

    function tiba_di_tujuan(id){
        $.ajax({
            type:'get',
            url:'/admin/pesanan/tiba-di-tujuan/'+id,
            success:function(data){
                $('#tiba-di-tujuan-data').html(data)
                toastr.options = {
                    "timeOut": "5000",
                }
                toastr['success'](' Pesanan ID. '+id+' telah tiba di tujuan');
            }
        })
    }

</script>
    
@endsection
