
$(window).on('load', function(){
    get_keranjang_data();
})

function get_keranjang_data(){
    $.ajax({
        type:'get',
        url:'/keranjang-data',
        success:function(data){
            $('#keranjang-loader').hide();
            $('#keranjang-data').html(data);
            btn_belanja();
            delete_from_cart();
            jumlah_tambah();
            jumlah_kurang();
            lanjut_bayar();
            $('[data-toggle="tooltip"]').tooltip()
        }
    })
}

function btn_belanja(){
    $('.btn-belanja').on('click', function(){
        window.location = '/';
    })
}

function delete_from_cart(){
    $('.delete-from-cart').on('click', function(){
        var jumlah_keranjang = parseInt($('#badge-keranjang').html());
        var id = $(this).data('idkeranjang');
        $.ajax({
            type:'get',
            url:'/hapus-keranjang/'+id,
            success:function(data){
                $('#keranjang-data').html(data);
                delete_from_cart();
                jumlah_tambah();
                jumlah_kurang();
                btn_belanja();
                lanjut_bayar();
                $('[data-toggle="tooltip"]').tooltip()
            }
        })
        $.ajax({
            type:'get',
            url:'/keranjang/total',
            success:function(data){
                if (data > 0) {
                    $('#badge-keranjang').html(data);
                }else{
                    $('#badge-keranjang').remove();
                }
            }
        })
    })
}

function jumlah_tambah(){
    $('.value-plus').on('click', function(){
        var jumlah_keranjang = parseInt($('#badge-keranjang').html());
        var keranjang_id = $(this).data('idkeranjang');
        var jumlah = parseInt($('#'+keranjang_id+' span').html());
        $('#'+keranjang_id+' span').html(jumlah + 1);
        $('#badge-keranjang').html(jumlah_keranjang + 1);
        var jumlah_produk = $('#'+keranjang_id+' span').html();
        $.ajax({
            type:'get',
            url:'/keranjang-produk-update/'+keranjang_id+'/'+jumlah_produk,
            success:function(data){
                $('#keranjang-data').html(data);
                delete_from_cart();
                jumlah_tambah();
                jumlah_kurang();
                lanjut_bayar();
                $('[data-toggle="tooltip"]').tooltip()
            }
        });
    })
}

function jumlah_kurang(){
    $('.value-minus').on('click', function(){
        var jumlah_keranjang = parseInt($('#badge-keranjang').html());
        var keranjang_id = $(this).data('idkeranjang');
        var jumlah = parseInt($('#'+keranjang_id+' span').html());
        if (jumlah > 1) {
            $('#'+keranjang_id+' span').html(jumlah - 1);
            $('#badge-keranjang').html(jumlah_keranjang - 1);
            var jumlah_produk = $('#'+keranjang_id+' span').html();
            $.ajax({
                type:'get',
                url:'/keranjang-produk-update/'+keranjang_id+'/'+jumlah_produk,
                success:function(data){
                    $('#keranjang-data').html(data);
                    delete_from_cart();
                    jumlah_tambah();
                    jumlah_kurang();
                    lanjut_bayar();
                    $('[data-toggle="tooltip"]').tooltip()
                }
            });
        }
    })
}

function lanjut_bayar(){
    $('.lanjut-bayar').on('click', function(){
        $.ajax({
            type:'get',
            url:'/lanjut-pesanan/cek-stok',
            success:function(result){
                if (result.response == "failed") {
                    toastr.options = {
                        "timeOut": "5000",
                    }
                    toastr['info'](result.message);
                }else if (result.response == "success") {
                    window.location = '/informasi-pesanan'
                }
            }
        })
    })
}
