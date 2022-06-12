$(window).on('load', function(){
    notification_badge()
})

function notification_badge(){
    $.ajax({
        type:'get',
        url:'/admin/notification-badge',
        success:function(data){

            // Pesanan
            if (data.menunggu_konfirmasi.length > 0 || data.validasi_pembayaran.length > 0) {
                $('#label-new-pesanan').remove();
                $('#pesanan').append('<span id="label-new-pesanan" class="label label-danger" style="margin-left: 20px; background: rgba(255, 0, 0, 0.781)">NEW</span>')
            }else{
                $('#label-new-pesanan').remove();
            }

            if (data.menunggu_konfirmasi.length > 0) {
                $('#badge-menunggu-konfirmasi').remove();
                $('#menunggu-konfirmasi').append('&nbsp;<span id="badge-menunggu-konfirmasi" class="badge" style="padding:2px 4px">'+data.menunggu_konfirmasi.length+'</span>')
            }else{
                $('#badge-menunggu-konfirmasi').remove();
            }
            
            if (data.validasi_pembayaran.length > 0) {
                $('#badge-validasi-pembayaran').remove();
                $('#validasi-pembayaran').append('&nbsp;<span id="badge-validasi-pembayaran" class="badge" style="padding:2px 4px">'+data.validasi_pembayaran.length+'</span>')
            }else{
                $('#badge-validasi-pembayaran').remove();
            }

            if (data.pengiriman.length > 0) {
                $('#badge-pengiriman').remove();
                $('#pengiriman').append('&nbsp;<span id="badge-pengiriman" class="badge" style="padding:2px 4px; background: rgb(0, 174, 255)">'+data.pengiriman.length+'</span>')
            }else{
                $('#badge-pengiriman').remove();
            }
        }
    })
}