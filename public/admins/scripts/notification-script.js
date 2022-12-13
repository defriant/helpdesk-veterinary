
var pusher = new Pusher('77c3bdf5fd626a80691a', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('admin-channel');

// Push Notif Konfirmasi Pesanan
channel.bind('konfirmasi-pesanan-event', function () {
    notification_badge();
    $.ajax({
        type: 'get',
        url: '/admin/pesanan/menunggu-konfirmasi-data',
        success: function (data) {
            $('#menunggu-konfirmasi-data').html(data)
            toastr.options = {
                "timeOut": "5000",
            }
            toastr['info']('Pesanan baru menunggu konfirmasi <br/> <a href="/admin/pesanan/menunggu-konfirmasi">Lihat...</a>');
        }
    })
});

channel.bind('custom-konfirmasi-pesanan-event', function () {
    notification_badge();
    $.ajax({
        type: 'get',
        url: '/admin/custom-pesanan/menunggu-konfirmasi-data',
        success: function (data) {
            $('#custom-menunggu-konfirmasi-data').html(data)
            currencyInput()
            toastr.options = {
                "timeOut": "5000",
            }
            toastr['info']('Custom Pesanan baru menunggu konfirmasi <br/> <a href="/admin/custom-pesanan/menunggu-konfirmasi">Lihat...</a>');
        }
    })
});

// Push Notif Validasi Pembayaran
channel.bind('validasi-pembayaran-event', function (data) {
    notification_badge();
    var pesanan_id = data.pesanan_id
    $.ajax({
        type: 'get',
        url: '/admin/pesanan/validasi-pembayaran-data',
        success: function (data) {
            $('#validasi-pembayaran-data').html(data)
            toastr.options = {
                "timeOut": "5000",
            }
            toastr['info']('Pesanan ID. ' + pesanan_id + ' Menunggu Validasi Pembayaran <br/> <a href="/admin/pesanan/validasi-pembayaran">Lihat...</a>');
        }
    })
});

channel.bind('validasi-pembayaran-custom-event', function (data) {
    notification_badge();
    var pesanan_id = data.pesanan_id
    $.ajax({
        type: 'get',
        url: '/admin/custom-pesanan/validasi-pembayaran-data',
        success: function (data) {
            $('#custom-validasi-pembayaran-data').html(data)
            toastr.options = {
                "timeOut": "5000",
            }
            toastr['info']('Custom Pesanan ID. ' + pesanan_id + ' Menunggu Validasi Pembayaran <br/> <a href="/admin/custom-pesanan/validasi-pembayaran">Lihat...</a>');
        }
    })
});