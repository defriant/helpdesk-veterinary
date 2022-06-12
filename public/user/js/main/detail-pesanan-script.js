
$('#form-bukti-pembayaran').on('submit', function(e){
    e.preventDefault();
    if ($('#bukti-pembayaran-input').val().length == 0) {
        $('#preview-bukti-pembayaran').addClass('invalid');
        $('#foto-bukti-pembayaran-invalid').show();
    }else{
        id_pesanan = $('#id-pesanan').val();
        var form_data = new FormData($(this)[0]);
        $.ajax({
            type:'POST',
            url:'/upload-bukti-pembayaran',
            data:form_data,
            contentType: false,
            processData: false,
            success:function(data){
                status_pesanan(id_pesanan);
                $('#bukti-pembayaran-upload').modal('toggle');
                toastr.options = {
                    "timeOut": "5000",
                }
                toastr['success']('Berhasil upload bukti pembayaran');
            }
        })
    }
})

function status_pesanan(id_pesanan){
    $.ajax({
        type:'GET',
        url:'/get-status-pesanan/'+id_pesanan,
        success:function(data){
            $('#status-pesanan-'+id_pesanan).html(data);
        }
    })
}

function detail_harga(id_pesanan){
    $.ajax({
        type:'GET',
        url:'/get-detail-harga/'+id_pesanan,
        success:function(result){
            console.log(result);
            let pb = ``
            $.each(result.pb, function(i, v){
                pb = pb + `<li style="margin-bottom: 10px">
                                <h5 style="font-size: 13px"><b>${v.nama}</b> x ${v.jumlah}<span style="float: right">Rp ${v.total}</span></h5>
                            </li>`
            })

            if (result.pesanan.ongkir != null) {
                pb = pb + `<li style="margin-bottom: 10px">
                                <h5 style="font-size: 13px">
                                    <b>Ongkir</b>
                                    <span style="float: right">Rp ${result.pesanan.ongkir}</span>
                                </h5>
                            </li>`
            }else{
                pb = pb + `<li style="margin-bottom: 10px">
                                <h5 style="font-size: 13px">
                                    <b>Ongkir</b>
                                    <i class="far fa-info-circle" style="margin-left: 5px" data-toggle="tooltip" data-placement="right" title="Ditentukan saat pesanan dikonfirmasi oleh admin"></i>
                                    <span style="float: right">-</span>
                                </h5>
                            </li>`
            }

            $('#detail-harga-barang').html(pb)
            $('#total-belanja').html(`<b>Rp ${result.pesanan.total}</b>`)
        }
    })
}

function status_pesanan_custom(id_pesanan){
    $.ajax({
        type:'GET',
        url:'/get-status-pesanan/'+id_pesanan,
        success:function(data){
            $('#status-pesanan-'+id_pesanan).html(data);
        }
    })
}

$('#bukti-pembayaran-input').on('input', function(){
    $('#preview-bukti-pembayaran').removeClass('invalid');
    $('#foto-bukti-pembayaran-invalid').hide();
})

$('#view-bukti-pembayaran').on('show.bs.modal', function(e){
    var button = $(e.relatedTarget);
    var view = button.data('view');
    var modal = $(this);
    modal.find('.modal-body #view-bukti-pembayaran').attr('src', view);
})

function pesanan_selesai(id){
    $.ajax({
        type:'get',
        url:'/pesanan/'+id+'/selesai',
        success:function(){
            status_pesanan(id);
            toastr.options = {
                "timeOut": "5000",
            }
            toastr['success']('Pesanan selesai, terimakasih telah berbelanja di toko kami &nbsp;<i class="far fa-smile"></i>');
        }
    })
}