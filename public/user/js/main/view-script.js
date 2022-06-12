$(window).on('load', function(){
    view_script();
})

function view_script(){
    let stok_produk = parseInt($('#stok-produk').val())
    $('#jumlah-tambah').on('click', function(){
        var jumlah = parseInt($('#jumlah').val()) + 1;
        if ($('#jumlah').val().length == 0) {
            $('#jumlah').val(1);
        }else if (jumlah > stok_produk) {
            $('#jumlah').val(stok_produk);
        }else {
            var jumlah = parseInt($('#jumlah').val());
            $('#jumlah').val(jumlah + 1);
        }
    })

    $('#jumlah-kurang').on('click', function(){
        var jumlah = parseInt($('#jumlah').val());
        if (jumlah > 1) {
            $('#jumlah').val(jumlah - 1);
        }
    })

    $('#jumlah').on('keypress', function(e){
        var charCode = (e.which) ? e.which : e.keyCode;
        if(charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
        }
        return true;
    })

    $('#jumlah').on('input', function(){
        var jumlah = parseInt($('#jumlah').val());
        if (jumlah < 1) {
            $('#jumlah').val(1);
        }else if (jumlah > stok_produk) {
            $('#jumlah').val(stok_produk);
        }
    })

    $('#tambah-keranjang').on('click', function(){
        if ($('#jumlah').val().length == 0) {
            alert('Masukan jumlah barang');
        }else{
            var jumlah_keranjang = parseInt($('#badge-keranjang').html());
            var id = $(this).data('idproduk');
            var jumlah = $('#jumlah').val();
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
        }
        
    })
}