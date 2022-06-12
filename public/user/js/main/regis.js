$('#submit-register').on('click', function(){
    $('#submit-loading').fadeIn(500);
    if ($('#nama').val().length == 0) {
        $('#nama').addClass('invalid');
        $('#nama-invalid').show();
        $('#submit-loading').fadeOut(500);
    }else if ($('#telp').val().length == 0){
        $('#telp').addClass('invalid');
        $('#telp-invalid').show();
        $('#submit-loading').fadeOut(500);
    }else if ($('#alamat').val().length == 0){
        $('#alamat').addClass('invalid');
        $('#alamat-invalid').show();
        $('#submit-loading').fadeOut(500);
    }else if ($('#email').val().length == 0){
        $('#email').addClass('invalid');
        $('#email-kosong').show();
        $('#submit-loading').fadeOut(500);
    }else if ($('#password').val().length == 0){
        $('#password').addClass('invalid');
        $('#password-invalid').show();
        $('#submit-loading').fadeOut(500);
    }else if ($('#password').val() != $('#konfirm-password').val()){
        $('#password').addClass('invalid');
        $('#konfirm-password').addClass('invalid');
        $('#konfirm-password-invalid').show();
        $('#submit-loading').fadeOut(500);
    }
    else{
        var email = $('#email').val();
        $.ajax({
            type:'get',
            url:'/mail-check/'+email,
            success:function(data){
                if (data.length > 0) {
                    $('#email').addClass('invalid');
                    $('#email-invalid').show();
                    $('#submit-loading').fadeOut(500);
                }else{
                    $('#form-regis').submit();
                    $('#form-regis').on('submit', function(e){
                        e.preventDefault();
                    })
                }
            }
        }) 
    }
    
})

$('#telp').on('keypress', function(e){
    var charCode = (e.which) ? e.which : e.keyCode;
    if(charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
});

$('#nama').on('input', function(){
    $('#nama').removeClass('invalid');
    $('#nama-invalid').hide();
})

$('#telp').on('input', function(){
    $('#telp').removeClass('invalid');
    $('#telp-invalid').hide();
})

$('#alamat').on('input', function(){
    $('#alamat').removeClass('invalid');
    $('#alamat-invalid').hide();
})

$('#email').on('input', function(){
    $('#email').removeClass('invalid');
    $('#email-kosong').hide();
    $('#email-invalid').hide();
})

$('#password').on('input', function(){
    $('#password').removeClass('invalid');
    $('#password-invalid').hide();
})

$('#konfirm-password').on('input', function(){
    $('#konfirm-password').removeClass('invalid');
    $('#password').removeClass('invalid');
    $('#konfirm-password-invalid').hide();
})


// Verifikasi script

$('.form-code').on('keypress', function(e){
    var charCode = (e.which) ? e.which : e.keyCode;
    if(charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
});

// hapus value saat foccus ke form input
$('#code1').on('focus', function(){
    $(this).val('');
})

$('#code2').on('focus', function(){
    $(this).val('');
})

$('#code3').on('focus', function(){
    $(this).val('');
})

$('#code4').on('focus', function(){
    $(this).val('');
})

// tambah class foccus saat form di klik
$('.form-code').on('click', function(){
    $('.form-code').removeClass('foccus');
    $(this).addClass('foccus');
})


// pindah ke form selanjutnya saat input
$('#code1').on('input', function(){
    $(this).removeClass('foccus');
    $('.form-code').removeClass('invalid');
    $('#code-kosong').hide();
    $('#code-invalid').hide();
    $('#code2').focus();
    $('#code2').addClass('foccus');
})

$('#code2').on('input', function(){
    $(this).removeClass('foccus');
    $('.form-code').removeClass('invalid');
    $('#code-kosong').hide();
    $('#code-invalid').hide();
    $('#code3').focus();
    $('#code3').addClass('foccus');
})

$('#code3').on('input', function(){
    $(this).removeClass('foccus');
    $('.form-code').removeClass('invalid');
    $('#code-kosong').hide();
    $('#code-invalid').hide();
    $('#code4').focus();
    $('#code4').addClass('foccus');
})

$('#code4').on('input', function(){
    $(this).removeClass('foccus');
    $('.form-code').removeClass('invalid');
    $('#code-kosong').hide();
    $('#code-invalid').hide();
    $('.form-code').blur();
})

$('#submit-verifikasi').on('click', function(){
    if ($('#code1').val().length == 0) {
        $('.form-code').addClass('invalid');
        $('#code-kosong').show();
    }else if ($('#code2').val().length == 0){
        $('.form-code').addClass('invalid');
        $('#code-kosong').show();
    }else if ($('#code3').val().length == 0){
        $('.form-code').addClass('invalid');
        $('#code-kosong').show();
    }else if ($('#code4').val().length == 0){
        $('.form-code').addClass('invalid');
        $('#code-kosong').show();
    }else{
        var id = $('#regis-id').val();
        var attempt_code = $('#code1').val()+$('#code2').val()+$('#code3').val()+$('#code4').val();
        $.ajax({
            type:'get',
            url:'/verification-attempt/'+id,
            success:function(data){
                if (data == attempt_code) {
                    $('#form-verifikasi').submit();
                    $('#form-verifikasi').on('submit', function(e){
                        e.preventDefault();
                    });
                }else{
                    $('.form-code').addClass('invalid');
                    $('#code-invalid').show();
                }
            }
        })
    }
})

$('.resend-link').on('click', function(){
    $(this).hide();
    $('#resend-loading').fadeIn(500);
    var id = $('#regis-id').val();
    $.ajax({
        type:'get',
        url:'/verification-resend/'+id,
        success:function(data){
            $('#alert-resend').fadeIn(500);
            $('#alert-resend').delay(5000).fadeOut(500);
            $('#resend-loading').hide();
            $('.resend-link').fadeIn(500);
        }
    })
})