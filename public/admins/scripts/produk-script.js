
// Halaman selesai loading
$(window).on('load', function(){
    // 
})

// Ambil data semua produk
function produk_data(){
    $.ajax({
        type:'get',
        url:'/admin/produk-data',
        success:function(data){
            $('#loading-search-icon').hide();
            $('#search-icon').show();
            $('#produk').empty();
            $('#produk').html(data);
        }
    })
}

// var tambah_gambar_input = document.querySelector('#tambah-gambar-input');
// tambah_gambar_input.addEventListener('change', tambah_preview);
// function tambah_preview(){
//     var fileObject = this.files[0];
//     var fileReader = new FileReader();
//     fileReader.readAsDataURL(fileObject);
//     fileReader.onload = function(){
//         var result = fileReader.result;
//         var img = document.querySelector('#tambah-gambar-preview');
//         img.setAttribute('src', result);
//     }
// }

$('#tambah-gambar-input-1').on('change', function(){
    $('#tambah-gambar-preview-1').removeClass('invalid');
    $('#invalid-gambar-1').hide();
    var fileObject = this.files[0];
    var fileReader = new FileReader();
    fileReader.readAsDataURL(fileObject);
    fileReader.onload = function(){
        var result = fileReader.result;
        $('#tambah-gambar-preview-1').css('background-image', `url('${result}')`)
    }
})

$('#tambah-gambar-input-2').on('change', function(){
    $('#tambah-gambar-preview-2').removeClass('invalid');
    $('#invalid-gambar-2').hide();
    var fileObject = this.files[0];
    var fileReader = new FileReader();
    fileReader.readAsDataURL(fileObject);
    fileReader.onload = function(){
        var result = fileReader.result;
        $('#tambah-gambar-preview-2').css('background-image', `url('${result}')`)
    }
})

$('#tambah-gambar-input-3').on('change', function(){
    $('#tambah-gambar-preview-3').removeClass('invalid');
    $('#invalid-gambar-3').hide();
    var fileObject = this.files[0];
    var fileReader = new FileReader();
    fileReader.readAsDataURL(fileObject);
    fileReader.onload = function(){
        var result = fileReader.result;
        $('#tambah-gambar-preview-3').css('background-image', `url('${result}')`)
    }
})

// Proses tambah produk
let gambar_default = $('#tambah-gambar-default').val();
$('#form-tambah-produk').submit(function(e){
    e.preventDefault();
    if ($('#tambah-gambar-input-1').val().length == 0) {
        $('#tambah-gambar-preview-1').addClass('invalid');
        $('#invalid-gambar-1').show();
    }else if ($('#tambah-gambar-input-2').val().length == 0) {
        $('#tambah-gambar-preview-2').addClass('invalid');
        $('#invalid-gambar-2').show();
    }else if ($('#tambah-gambar-input-3').val().length == 0) {
        $('#tambah-gambar-preview-3').addClass('invalid');
        $('#invalid-gambar-3').show();
    }else if($('#tambah-kategori').val().length == 0){
        $('#tambah-kategori').addClass('invalid');
        $('#invalid-kategori').show();
    }else if($('#tambah-nama').val().length == 0){
        $('#tambah-nama').addClass('invalid');
        $('#invalid-nama').show();
    }else if($('#tambah-harga').val().length == 0){
        $('#tambah-harga').addClass('invalid');
        $('#invalid-harga').show();
    }else if($('#tambah-stock').val().length == 0){
        $('#tambah-stock').addClass('invalid');
        $('#invalid-stock').show();
    }else if($('#tambah-deskripsi').val().length == 0){
        $('#tambah-deskripsi').addClass('invalid');
        $('#invalid-deskripsi').show();
    }else{
        $('#tambah-loading').show();
        $('#btn-tambah-produk').hide();
        $('#modal-tambah-close').hide();
        var nama_produk = $('#tambah-nama').val();
        var form_data = new FormData($(this)[0]);
        $.ajax({
            type:'POST',
            url:'/admin/tambah-produk',
            data:form_data,
            contentType: false,
            processData: false,
            success:function(result){
                produk_data();
                $('#modal-tambah-close').click();
                $('#tambah-gambar-preview-1').attr('style', `background-image: url(${gambar_default});`);
                $('#tambah-gambar-preview-2').attr('style', `background-image: url(${gambar_default});`);
                $('#tambah-gambar-preview-3').attr('style', `background-image: url(${gambar_default});`);
                $('#btn-tambah-produk').show();
                $('#modal-tambah-close').show();
                $('#tambah-loading').hide();
                $('#tambah-gambar-input-1').val('');
                $('#tambah-gambar-input-2').val('');
                $('#tambah-gambar-input-3').val('');
                $('#tambah-kategori').val('');
                $('#tambah-nama').val('');
                $('#tambah-harga').val('');
                $('#tambah-stock').val('');
                $('#tambah-deskripsi').val('');
                toastr.options = {
                    "timeOut": "5000",
                }
                toastr['success'](nama_produk+' berhasil ditambahkan');
            }
        })
    }
})

$('#tambah-kategori').on('input', function(){
    $('#tambah-kategori').removeClass('invalid');
    $('#invalid-kategori').hide();
})

$('#tambah-nama').on('input', function(){
    $('#tambah-nama').removeClass('invalid');
    $('#invalid-nama').hide();
})

$('#tambah-harga').on('keypress', function(e){
    var charCode = (e.which) ? e.which : e.keyCode;
    if(charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
})

$('#tambah-harga').on('input', function(){
    $('#tambah-harga').removeClass('invalid');
    $('#invalid-harga').hide();
})

$('#tambah-stock').on('keypress', function(e){
    var charCode = (e.which) ? e.which : e.keyCode;
    if(charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
})

$('#tambah-stock').on('input', function(){
    $('#tambah-stock').removeClass('invalid');
    $('#invalid-stock').hide();
})

$('#tambah-deskripsi').on('input', function(){
    $('#tambah-deskripsi').removeClass('invalid');
    $('#invalid-deskripsi').hide();
})


$('input[name="kategori"]').on('click', function(){
    $.ajax({
        type:'get',
        url:'/admin/produk-data/' + $(this).val(),
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
            url:'/cari-produk/'+id,
            success:function(data){
                $('#loading-search-icon').hide();
                $('#search-icon').show();
                $('#produk').html(data);
            }
        })
    }
})

// Mengambil data barang ketika modal update muncul
$('#modal-update-produk').on('show.bs.modal', function(e){
    $('#update-kategori').removeClass('invalid');
    $('#invalid-update-kategori').hide();

    $('#update-nama').removeClass('invalid');
    $('#invalid-update-nama').hide();

    $('#update-harga').removeClass('invalid');
    $('#invalid-update-harga').hide();

    $('#update-stock').removeClass('invalid');
    $('#invalid-update-stock').hide();

    $('#update-deskripsi').removeClass('invalid');
    $('#invalid-update-deskripsi').hide();

    var button = $(e.relatedTarget);
    var id_produk = button.data('idproduk');
    // var gambar = button.data('upgambar');
    var gambar1 = button.data('upgambar1')
    var gambar2 = button.data('upgambar2')
    var gambar3 = button.data('upgambar3')
    var kategori = button.data('upkategori');
    var nama = button.data('upnama');
    var harga = button.data('upharga');
    var stock = button.data('upstock');
    var deskripsi = button.data('updeskripsi');
    var modal = $(this);
    modal.find('.modal-body #produk-id').val(id_produk);
    // modal.find('.modal-body #update-gambar-preview').attr('src', gambar);
    // modal.find('.modal-body #update-gambar-input').val('');

    modal.find('.modal-body #update-gambar-preview-1').css('background-image', `url('${gambar1}')`);
    modal.find('.modal-body #update-gambar-input-1').val('');

    modal.find('.modal-body #update-gambar-preview-2').css('background-image', `url('${gambar2}')`);
    modal.find('.modal-body #update-gambar-input-2').val('');

    modal.find('.modal-body #update-gambar-preview-3').css('background-image', `url('${gambar3}')`);
    modal.find('.modal-body #update-gambar-input-3').val('');

    modal.find('.modal-body #update-kategori').val(kategori);
    modal.find('.modal-body #update-nama').val(nama);
    modal.find('.modal-body #update-harga').val(harga);
    modal.find('.modal-body #update-stock').val(stock);
    modal.find('.modal-body #update-deskripsi').val(deskripsi);
})

$('#update-gambar-input-1').on('change', function(){
    var fileObject = this.files[0];
    var fileReader = new FileReader();
    fileReader.readAsDataURL(fileObject);
    fileReader.onload = function(){
        var result = fileReader.result;
        $('#update-gambar-preview-1').css('background-image', `url('${result}')`)
    }
})

$('#update-gambar-input-2').on('change', function(){
    var fileObject = this.files[0];
    var fileReader = new FileReader();
    fileReader.readAsDataURL(fileObject);
    fileReader.onload = function(){
        var result = fileReader.result;
        $('#update-gambar-preview-2').css('background-image', `url('${result}')`)
    }
})

$('#update-gambar-input-3').on('change', function(){
    var fileObject = this.files[0];
    var fileReader = new FileReader();
    fileReader.readAsDataURL(fileObject);
    fileReader.onload = function(){
        var result = fileReader.result;
        $('#update-gambar-preview-3').css('background-image', `url('${result}')`)
    }
})

// Proses update produk
$('#form-update-produk').submit(function(e){
    e.preventDefault();
    if($('#update-kategori').val().length == 0){
        $('#update-kategori').addClass('invalid');
        $('#invalid-update-kategori').show();
    }else if($('#update-nama').val().length == 0){
        $('#update-nama').addClass('invalid');
        $('#invalid-update-nama').show();
    }else if($('#update-harga').val().length == 0){
        $('#update-harga').addClass('invalid');
        $('#invalid-update-harga').show();
    }else if($('#update-stock').val().length == 0){
        $('#update-stock').addClass('invalid');
        $('#invalid-update-stock').show();
    }else if($('#update-deskripsi').val().length == 0){
        $('#update-deskripsi').addClass('invalid');
        $('#invalid-update-deskripsi').show();
    }else{
        $('#update-loading').show();
        $('#btn-update-produk').hide();
        $('#btn-hapus-produk').hide();
        $('#modal-update-close').hide();

        var id_produk = $('#produk-id').val();
        var nama_produk = $('#update-nama').val();
        var form_data = new FormData($(this)[0]);
        $.ajax({
            type:'POST',
            url:'/admin/update-produk/'+id_produk,
            data:form_data,
            contentType: false,
            processData: false,
            success:function(result){
                produk_data();
                $('#modal-update-close').click();
                $('#update-loading').hide();
                $('#btn-update-produk').show();
                $('#btn-hapus-produk').show();
                $('#modal-update-close').show();
                toastr.options = {
                    "timeOut": "5000",
                }
                toastr['success']('Berhasil update data produk '+nama_produk);
            }
        })
    }
})

$('#update-kategori').on('input', function(){
    $('#update-kategori').removeClass('invalid');
    $('#invalid-update-kategori').hide();
})

$('#update-nama').on('input', function(){
    $('#update-nama').removeClass('invalid');
    $('#invalid-update-nama').hide();
})

$('#update-harga').on('keypress', function(e){
    var charCode = (e.which) ? e.which : e.keyCode;
    if(charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
})

$('#update-harga').on('input', function(){
    $('#update-harga').removeClass('invalid');
    $('#invalid-update-harga').hide();
})

$('#update-stock').on('keypress', function(e){
    var charCode = (e.which) ? e.which : e.keyCode;
    if(charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
})

$('#update-stock').on('input', function(){
    $('#update-stock').removeClass('invalid');
    $('#invalid-update-stock').hide();
})

$('#update-deskripsi').on('input', function(){
    $('#update-deskripsi').removeClass('invalid');
    $('#invalid-update-deskripsi').hide();
})

// Proses hapus produk
$('#btn-hapus-produk').on('click', function(){
    $('#hapus-loading').show();
    $('#btn-update-produk').hide();
    $('#btn-hapus-produk').hide();
    $('#modal-update-close').hide();

    var id_produk = $('#produk-id').val();
    var nama_produk = $('#update-nama').val();
    $.ajax({
        type:'get',
        url:'/admin/delete-produk/'+id_produk,
        success:function(){
            produk_data();
            $('#modal-update-close').click();
            $('#hapus-loading').hide();
            $('#btn-update-produk').show();
            $('#btn-hapus-produk').show();
            $('#modal-update-close').show();
            toastr.options = {
				"timeOut": "5000",
			}
			toastr['error']('Berhasil menghapus data produk '+nama_produk);
        }
    })
})