
// Halaman selesai loading
$(window).on('load', function(){
    // 
})

// Ambil data semua produk
function produk_data(){
    $.ajax({
        type:'get',
        url:'/owner/produk-data',
        success:function(data){
            $('#loading-search-icon').hide();
            $('#search-icon').show();
            $('#produk').html(data);
        }
    })
}

// Filter semua klik
$('input[name="kategori"]').on('click', function(){
    let kategori = $(this).val()
    if (kategori == "semua") {
        produk_data();
    } else {
        $.ajax({
            type:'get',
            url:`/owner/produk-data/${kategori}`,
            success:function(data){
                $('#produk').html(data);
            }
        })
    }
})

$('#semua').on('click', function(){
    produk_data();
})

// Filter kitchen set klik
$('#kitchen-set').on('click', function(){
    $.ajax({
        type:'get',
        url:'/owner/produk-data/kitchen-set',
        success:function(data){
            $('#produk').html(data);
        }
    })
})

// FIlter Tempat Tidur klik
$('#tempat-tidur').on('click', function(){
    $.ajax({
        type:'get',
        url:'/owner/produk-data/tempat-tidur',
        success:function(data){
            $('#produk').html(data);
        }
    })
})

// Filter lemari klik
$('#lemari').on('click', function(){
    $.ajax({
        type:'get',
        url:'/owner/produk-data/lemari',
        success:function(data){
            $('#produk').html(data);
        }
    })
})

// Filter meja klik
$('#meja').on('click', function(){
    $.ajax({
        type:'get',
        url:'/owner/produk-data/meja',
        success:function(data){
            $('#produk').html(data);
        }
    })
})

// filter kursi klik
$('#kursi').on('click', function(){
    $.ajax({
        type:'get',
        url:'/owner/produk-data/kursi',
        success:function(data){
            $('#produk').html(data);
        }
    })
})

// Cari produk
$('#cari-produk').on('input', function(){
    if ($('#cari-produk').val().length == 0) {
        produk_data();
    }else if ($('#cari-produk').val().length % 3 == 0) {
        $('#search-icon').hide();
        $('#loading-search-icon').show();
        var id = $('#cari-produk').val()
        $.ajax({
            type:'get',
            url:'/owner/cari-produk/'+id,
            success:function(data){
                $('#loading-search-icon').hide();
                $('#search-icon').show();
                $('#produk').html(data);
            }
        })
    }
})