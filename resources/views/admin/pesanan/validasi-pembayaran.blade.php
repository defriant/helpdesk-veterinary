@extends('layouts.admin_ui')
@section('content')

<div class="main-content">
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h4 class="pesanan-title"><b>PESANAN / <span style="color: #00AAFF">VALIDASI PEMBAYARAN</span></b></h4>
            </div>
            <div class="panel-body" style="margin-top: 20px">
                <div class="row">
                    <div class="pesanan-list">
                        <div id="validasi-pembayaran-data">
                            @include('admin.pesanan.validasi-pembayaran-data')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OVERVIEW -->
    </div>
</div>


{{-- Modal view bukti pembayaran --}}
<div class="modal fade" id="bukti-pembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-info">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -10px"><span aria-hidden="true">&times;</span></button>	
                <img id="bukti-pembayaran" src="" class="" width="100%" alt="">
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $('#bukti-pembayaran').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var img = button.data('img');
        var modal = $(this);
        modal.find('.modal-body #bukti-pembayaran').attr('src', img);
    })

    function valid(id){
        $.ajax({
            type:'get',
            url:'/admin/pesanan/valid/'+id,
            success:function(data){
                notification_badge();
                $('#validasi-pembayaran-data').html(data)
                toastr.options = {
                    "timeOut": "5000",
                }
                toastr['success']('Bukti pembayaran pesanan ID. '+id+' Divalidasi');
            }
        })
    }

    function invalid(id){
        $.ajax({
            type:'get',
            url:'/admin/pesanan/invalid/'+id,
            success:function(data){
                notification_badge();
                $('#validasi-pembayaran-data').html(data)
                toastr.options = {
                    "timeOut": "5000",
                }
                toastr['error']('Bukti pembayaran pesanan ID. '+id+' Invalid');
            }
        })
    }
</script>
    
@endsection
