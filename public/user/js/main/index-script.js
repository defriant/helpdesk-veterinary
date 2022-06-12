
$(window).on('load', function(){
    tambah_keranjang();
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
})

function all_item(){
    $.ajax({
        type:'get',
        url:'/all-item',
        success:function(data){
            $('#product-loader').hide()
            $('#product-data').html(data);
            tambah_keranjang()
            history.pushState('', '', '/');
        }
    });
}

$('#search-produk').on('input', function(){
    if ($('#search-produk').val().length == 0) {
        $('.btn-kategori').removeClass('active');
        $('#all').addClass('active')
        $('#search-icon').hide();
        $('#search-loading').show();
        $.ajax({
            type:'get',
            url:'/all-item',
            success:function(data){
                $('#search-loading').hide();
                $('#search-icon').show();
                $('#product-data').html(data);
                tambah_keranjang()
                $('.title-kategori h3 b').html('Semua Produk')
                $('.title-kategori').show();
                history.pushState('', '', '/');
            }
        });
    }else if($('#search-produk').val().length % 3 == 0){
        $('#search-icon').hide();
        $('#search-loading').show();
        $('.btn-kategori').removeClass('active');
        $('#all').addClass('active')
        var id = $('#search-produk').val()
        $.ajax({
            type:'get',
            url:'/search-produk/'+id,
            success:function(data){
                $('#search-loading').hide();
                $('#search-icon').show();
                $('#product-data').html(data);
                tambah_keranjang()
                $('.title-kategori h3 b').html('Semua Produk')
                $('.title-kategori').show();
                history.pushState('', '', '/');
            }
        })
    }
})

$('.btn-kategori').on('click', function(){
    $('#product-data').empty();
    $('#product-loader').fadeIn(500);
    $('.btn-kategori').removeClass('active');
    $(this).addClass('active');
    $('.title-kategori h3 b').html($(this).find('h5').eq(0).html())
    $('.title-kategori').show();
    let kategori = $(this).data('kategori')
    if (kategori == "all") {
        all_item()
    } else {
        $.ajax({
            type:'get',
            url:`/produk-data/${kategori}`,
            success:function(data){
                $('#product-loader').hide();
                $('#product-data').html(data);
                tambah_keranjang()
                history.pushState('', '', '/');
            }
        });
    }
})

function view_produk(url){
    $('#product-data').empty();
    $('#product-loader').fadeIn(500);
    $.ajax({
        type:'post',
        url:url,
        success:function(data){
            $('#product-loader').hide();
            $('.title-kategori').hide();
            $('.btn-kategori').removeClass('active');
            $('#product-data').html(data);
            view_script();
            history.pushState('', '', url);
            
        }
    })
    return false;
}

function tambah_keranjang(){
    $('.tambah-keranjang').on('click', function(){
        var jumlah_keranjang = parseInt($('#badge-keranjang').html());
        var id = $(this).data("idproduk");
        var jumlah = $(this).data("jumlah");
        $.ajax({
            type:'get',
            url:'/tambah-keranjang/'+id+'/'+jumlah,
            success:function(data){
                if (jumlah_keranjang > 0) {
                    $('#badge-keranjang').html(jumlah_keranjang + 1);
                }else{
                    $('#keranjang').append('<span id="badge-keranjang" class="badge badge-primary badge-notif">1</span>');
                }
                toastr.options = {
                    "timeOut": "5000",
                }
                
                toastr['info']('1 item ditambahkan ke keranjang <a href="/keranjang">Lihat keranjang...</a>');
            }
        })
    })
}

function no_telp(){
    $('#telp').on('keypress', function(e){
        var charCode = (e.which) ? e.which : e.keyCode;
        if(charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
        }
        return true;
    })
}

function persyaratan_check(){
    $('#persyaratan').on('click', function(){
        if ($('input[name="agree"]:checked').length > 0) {
            $('#persyaratan-text').removeClass('persyaratan-invalid')
            $('#persyaratan-text').addClass('persyaratan-valid')
        }else{
            $('#persyaratan-text').removeClass('persyaratan-valid')
            $('#persyaratan-text').addClass('persyaratan-invalid')
        }
    })
}

// Custom pesanan script
function custom_pesanan_submit(){
    if ($('#input-foto-contoh-barang').val().length == 0) {
        alert('Masukan foto contoh barang')
    }else if ($('#nama-barang').val().length == 0) {
        alert('Masukan nama barang')
    }else if ($('#kategori-barang').val().length == 0){
        alert('Pilih kategori barang')
        
    }else if ($('#kategori-barang').val() == 'kitchen-set') {
        if ($('#jumlah-panjang').val().length == 0 || $('#jumlah-panjang').val() == 0) {
            alert('Tentukan panjang')
        }else if($('#warna').val().length == 0){
            alert('Masukan tipe katalog warna')
        }else if ($('#deskripsi-barang').val().length == 0) {
            alert('Masukan deskripsi barang')
        }
        else if ($('#nama-pemesan').val().length == 0) {
            alert('Masukan Pemesan')
        }else if ($('#telp').val().length == 0) {
            alert('Masukan nomor telepon')
        }else if ($('#alamat').val().length == 0) {
            alert('Masukan alamat')
        }else if ($('input[name="agree"]:checked').length == 0) {
            alert('Setujui syarat dan ketentuan')
            $('#persyaratan-text').removeClass('persyaratan-valid')
            $('#persyaratan-text').addClass('persyaratan-invalid')
        }else{
            $('#form-custom-pesanan').submit();
            $('#form-custom-pesanan').on('submit', function(e){
                e.preventDefault();
            });
        }

    }else if ($('#kategori-barang').val() == 'dll'){
        if ($('#jumlah-panjang').val().length == 0 || $('#jumlah-panjang').val() == 0) {
            alert('Tentukan panjang')
        }else if ($('#jumlah-lebar').val().length == 0 || $('#jumlah-lebar').val() == 0) {
            alert('Tentukan lebar')
        }else if($('#warna').val().length == 0){
            alert('Masukan tipe katalog warna')
        }else if ($('#deskripsi-barang').val().length == 0) {
            alert('Masukan deskripsi barang')
        }
        else if ($('#nama-pemesan').val().length == 0) {
            alert('Masukan Pemesan')
        }else if ($('#telp').val().length == 0) {
            alert('Masukan nomor telepon')
        }else if ($('#alamat').val().length == 0) {
            alert('Masukan alamat')
        }else if ($('input[name="agree"]:checked').length == 0) {
            alert('Setujui syarat dan ketentuan')
            $('#persyaratan-text').removeClass('persyaratan-valid')
            $('#persyaratan-text').addClass('persyaratan-invalid')
        }else{
            $('#form-custom-pesanan').submit();
            $('#form-custom-pesanan').on('submit', function(e){
                e.preventDefault();
            });
        }
    }
}

function lihat_pesanan(){
    window.location = '/pesanan'
}

class requestData {
    post(params){
        let url = params.url
        let data = params.data

        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                contentType: 'application/json',
                data: JSON.stringify(data),
                success:function(result){
                    resolve(result)
                },
                error:function(result){
                    alert('Oops! Something went wrong ..')
                }
            })
        })
    }

    get(params){
        let url = params.url

        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: "json",
                contentType: 'application/json',
                success:function(result){
                    resolve(result)
                },
                error:function(result){
                    alert('Oops! Something went wrong ..')
                }
            })
        })
    }
}

const ajaxRequest = new requestData()
