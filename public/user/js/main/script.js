
// Custom dropdown script

var box = document.getElementById('notif-box');
var box = document.getElementById('akun-box');
var notif_down = false;
var akun_down = false;

$('#notif-toggle').on('click', function(){
    $('#akun-box').hide();
    $('#akun-toggle').removeClass('dropdown-active')
    akun_down = false;
    if(notif_down){
        $('#notif-box').hide();
        $('#notif-toggle').removeClass('dropdown-active')
        notif_down = false;
    }else {
        $('#notif-box').show();
        $('#notif-toggle').addClass('dropdown-active')
        notif_down = true;
        $.ajax({
            type:'get',
            url:'/notifikasi-read',
            success:function(data){
                $('#badge-notifikasi').remove();
            }
        });
    }
})

$('#akun-toggle').on('click', function(){
    $('#notif-box').hide();
    $('#notif-toggle').removeClass('dropdown-active')
    notif_down = false;
    if(akun_down){
        $('#akun-box').hide();
        $('#akun-toggle').removeClass('dropdown-active')
        akun_down = false;
    }else {
        $('#akun-box').show();
        $('#akun-toggle').addClass('dropdown-active')
        akun_down = true;
    }
})

$('.main').on('click', function(){
    $('#notif-box').hide();
    $('#notif-toggle').removeClass('dropdown-active');
    notif_down = false;
    $('#akun-box').hide();
    $('#akun-toggle').removeClass('dropdown-active');
    akun_down = false;

})

function notif_link(url){
    window.location = url;
    $('#notif-box').hide();
}

// End dropdown script


// Public Script

$(window).on('load', function() {
    // 
});

$('#keranjang').on('click', function(){
    window.location = '/keranjang';
})

$('#myModal4').on('show.bs.modal', function(){
    $(this).data('bs.modal').options.backdrop = 'static'
    $(this).data('bs.modal').options.keyboard = false
})

$('#myModal4').on('hide.bs.modal', function(){
    $('#login-content').html(signInContent)
    signInFunc()
})

function signInContent() {
    return `<div class="login">
                <div class="login-right">
                    <h3>Sign in with your account</h3>
                    <form id="form-sign-in">
                        <div class="sign-in">
                            <h4>Email :</h4>
                            <input id="account-email" type="text" class="" style="color: black">
                            <span id="account-invalid" class="helper-text"
                                style="color: red; display: none;"><i>Email atau password salah</i></span>
                        </div>
                        <div class="sign-in">
                            <h4>Password :</h4>
                            <input id="account-password" type="password" class="" style="color: black">
                        </div>
                        <div class="sign-in">
                            <button id="btn-sign-in" class="btn-sign-in" type="submit"><i
                                    id="sign-in-loading" class="far fa-spinner fa-spin"
                                    style="margin-right: 5px; display: none;"></i>SIGN IN</button>
                        </div>
                    </form>
                </div>
                <div style="display: flex; justify-content: center;">
                    <p id="lupa-password" style="color: coral; cursor: pointer; width: max-content;">Forget your password ?</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <p>By logging in you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></p>`
}

function signInFunc() {
    $('#account-email').on('input', function(){
        $(this).removeClass('invalid');
        $('#account-password').removeClass('invalid');
        $('#account-invalid').hide();
    })
    
    $('#account-password').on('input', function(){
        $(this).removeClass('invalid');
        $('#account-email').removeClass('invalid');
        $('#account-invalid').hide();
    })
    
    $('#form-sign-in').on('submit', function(event){
        event.preventDefault();
        $('#sign-in-loading').fadeIn(500);
        var data_post = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            email: $('#account-email').val(),
            password: $('#account-password').val(),
        }
        $.ajax({
            type:'post',
            url:'/attempt-login',
            data:data_post,
            success:function(data){
                if (data.success == true) {
                    window.location = '/check-this-user-role';
                    $('#sign-in-loading').hide();
                }else{
                    $('#account-email').addClass('invalid');
                    $('#account-password').addClass('invalid');
                    $('#account-invalid').show();
                    $('#sign-in-loading').fadeOut(500);
                }
            }
        })
    })

    $('#lupa-password').on('click', function(){
        $('#login-content').html(fpComponent.inputEmail())
        inputEmailFunc()
    })
}

$('#login-content').html(signInContent)
signInFunc()

function inputEmailFunc() {
    $('#btn-send-otp').on('click', function(){
        if ($('#fp-email').val().length == 0) {
            alert('Masukkan email')
        }else{
            $('#fp-email-invalid').hide()
            $('#send-otp-loading').show()
            $('#btn-send-otp').attr('disabled', true)
            $('#back-to-login').hide()
            $.ajax({
                type:'post',
                url:'/forget-password/verify-email',
                data:{
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    email: $('#fp-email').val(),
                },
                success:function(result){
                    $('#btn-send-otp').removeAttr('disabled')
                    $('#back-to-login').show()
                    $('#send-otp-loading').hide()
                    if (result.response == "failed") {
                        $('#fp-email-invalid').show()
                    }else if (result.response == "success") {
                        $('#close-myModal4').hide()
                        $('#login-content').html(fpComponent.verifikasiOtp(result.email))
                        verifikasiOtpFunc(result.code, result.email)
                    }
                    console.log(result);
                }
            })
        }
    })

    $('#back-to-login').on('click', function(){
        $('#login-content').html(signInContent)
        signInFunc()
    })
}

function verifikasiOtpFunc(code, email) {
    let otpCode = code
    $('.form-code').on('keypress', function(e){
        var charCode = (e.which) ? e.which : e.keyCode;
        if(charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
        }
        return true;
    });

    $('#code1').focus()
    
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
    
    $('.form-code').on('click', function(){
        $('.form-code').removeClass('foccus');
        $(this).addClass('foccus');
    })
    
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

    $('.resend-link').on('click', function(){
        $('#submit-verifikasi').hide()
        $(this).hide()
        $('#resend-loading').show()
        $.ajax({
            type:'post',
            url:'/forget-password/resend-otp',
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                email: email,
            },
            success:function(result){
                $('#submit-verifikasi').show()
                if (result.response == "success") {
                    $('.form-code').val('')
                    $('#code1').focus()
                    $('#code-kosong').hide();
                    $('#code-invalid').hide();
                    otpCode = result.code
                    $('#resend-loading').html(`<i class="far fa-check" style="margin-right: 5px;"></i>Berhasil mengirim ulang kode otp`)
                }
            }
        })
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
        }else {
            let otp = $('#code1').val() + $('#code2').val() + $('#code3').val() + $('#code4').val()
            if (otp == otpCode) {
                $('#login-content').html(fpComponent.setNewPass())
                setNewPassFunc(email)
            }else{
                $('#code-invalid').show()
            }
        }
    })
}

function setNewPassFunc(email) {
    $('#confirm-new-pass').on('input', function(){
        if ($(this).val() !== $('#new-pass').val()) {
            $('#confirm-new-pass-invalid').show()
        }else{
            $('#confirm-new-pass-invalid').hide()
        }
    })

    $('#btn-save-password').on('click', function(){
        if ($('#new-pass').val().length == 0) {
            alert('Masukkan password baru')
        }else if ($('#confirm-new-pass').val().length == 0) {
            alert('Masukkan konfirmasi password baru')
        }else{
            if ($('#new-pass').val() !== $('#confirm-new-pass').val()) {
                $('#confirm-new-pass-invalid').show()
            }else{
                $('#btn-save-password').attr('disabled', true)
                $('#save-password-loading').show()
                $.ajax({
                    type:'post',
                    url:'/forget-password/set-new-pass',
                    data:{
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        email: email,
                        password: $('#new-pass').val()
                    },
                    success:function(result){
                        $('#btn-save-password').removeAttr('disabled')
                        $('#save-password-loading').hide()
                        if (result.response == "success") {
                            $('#close-myModal4').show()
                            $('#login-content').html(fpComponent.fpFinish())
                            $('#login-now').on('click', function(){
                                $('#login-content').html(signInContent)
                                signInFunc()
                            })
                        }
                    }
                })
            }
        }
    })
}

$('#user-logout').on('click', function(){
    $('#akun-box').hide();
    window.location = '/user-logout';
})

window.addEventListener("popstate", function(e){
    window.location.href = location.href;
})

// End public script