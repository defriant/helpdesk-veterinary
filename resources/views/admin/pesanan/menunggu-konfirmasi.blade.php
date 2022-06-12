@extends('layouts.admin_ui')
@section('content')

<div class="main-content">
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h4 class="pesanan-title"><b>PESANAN / <span style="color: #00AAFF">MENUNGGU KONFIRMASI</span></b></h4>
            </div>
            <div class="panel-body" style="margin-top: 20px">
                <div class="row">
                    <div class="pesanan-list">
                        <div id="menunggu-konfirmasi-data">
                            @include('admin.pesanan.menunggu-konfirmasi-data')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OVERVIEW -->
    </div>
</div>

{{-- Modal batal pesanan --}}
<div class="modal fade" id="modal-batal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -10px"><span aria-hidden="true">&times;</span></button>
                <form id="form-batal-pesanan" method="POST">
                <div style="text-align: center; margin-top: 30px; margin-bottom: 30px">
                    <h5>Alasan Pembatalan</h5>
                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_pesanan" id="id-pesanan" value="">
                    <textarea class="form-control" id="alasan_pembatalan" name="alasan_pembatalan" style="resize: none; height: 70px;"></textarea>
                </div>
                <div style="text-align: right">
                    <button type="submit" class="btn btn-danger">Batalkan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>

    function konfirmasi(id){
        if ($('#ongkir').val().length == 0) {
            $('#ongkir').parent().addClass('invalid')
        }else{
            let ongkir = parseInt($('#ongkir').val().replaceAll('.', ''))
            $.ajax({
                type:'post',
                url:'/admin/pesanan/konfirmasi/'+id,
                headers:{
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    "ongkir": ongkir
                },
                success:function(data){
                    notification_badge()
                    $('#menunggu-konfirmasi-data').html(data)
                    toastr.options = {
                        "timeOut": "5000",
                    }
                    toastr['success']('Pesanan ID. '+id+' dikonfirmasi');
                }
            })
        }
    }

    $('#ongkir').on('input', function(){
        if ($(this).val().length != 0) {
            $('#ongkir').parent().removeClass('invalid')
        }
    })

    $('#modal-batal').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id_pesanan = button.data('idpesanan')
        var modal = $(this);
        modal.find('.modal-body #id-pesanan').val(id_pesanan)
    })

    $('#form-batal-pesanan').on('submit', function(e){
        e.preventDefault();
        var id = $('#id-pesanan').val();
        var form_data = {
            _token:$('#token').val(),
            id_pesanan:$('#id-pesanan').val(),
            alasan_pembatalan:$('#alasan_pembatalan').val(),
        };
        $.ajax({
            type:'POST',
            url:'/admin/pesanan/batal',
            data:form_data,
            success:function(data){
                notification_badge()
                $('#menunggu-konfirmasi-data').html(data)
                $('#modal-batal').modal('toggle');
                toastr.options = {
                    "timeOut": "5000",
                }
                toastr['error']('Pesanan ID. '+id+' dibatalkan');
            }
        })
    })

</script>

@endsection
