@extends('layouts.admin_ui')
@section('content')

<div class="main-content">
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h4 class="pesanan-title"><b>PESANAN / <span style="color: #00AAFF">PENGIRIMAN</span></b></h4>
            </div>
            <div class="panel-body" style="margin-top: 20px">
                <div class="row">
                    <div class="pesanan-list">
                        <div id="pengiriman-data">
                            @include('admin.pesanan.pengiriman-data')
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
    
    function antar(id){
        $.ajax({
            type:'get',
            url:'/admin/pesanan/antar/'+id,
            success:function(data){
                notification_badge();
                $('#pengiriman-data').html(data)
                toastr.options = {
                    "timeOut": "5000",
                }
                toastr['success'](' Mengantar pesanan ID. '+id);
            }
        })
    }

</script>
    
@endsection
