class forgetPasswordComponent {
    inputEmail(){
        return `<div class="login">
                    <div class="login-right">
                        <h3>Forget Password</h3>
                        <form id="form-sign-in">
                            <div class="sign-in">
                                <h4>Email :</h4>
                                <input id="fp-email" type="text" class="" style="color: black">
                                <span id="fp-email-invalid" class="helper-text"
                                    style="color: red; display: none;"><i>Email tidak ditemukan</i></span>
                            </div>
                            <div class="sign-in">
                                <button id="btn-send-otp" class="btn-sign-in" type="button"><i
                                        id="send-otp-loading" class="far fa-spinner fa-spin"
                                        style="margin-right: 5px; display: none;"></i>SEND OTP</button>
                            </div>
                        </form>
                    </div>
                    <div style="display: flex; justify-content: center;">
                        <p id="back-to-login" style="color: coral; cursor: pointer; width: max-content;">Back to login</p>
                    </div>
                    <div class="clearfix"></div>
                </div>`
    }

    verifikasiOtp(email){
        return `<h3 style="text-align: center; color: orange;">VERIFIKASI OTP</h3>
                    <div class="login">
                        <div class="login-bottom" style="margin-top: 50px;">
                            <div class="row">
                                <div class="col-sm-12 col-md-8 col-md-offset-2">
                                    <h5 style="text-align: center">Kode verifikasi telah dikirim ke email</h5>
                                    <h5 style="margin-top: 10px; text-align: center;"><i><b>${email}</b></i></h5>
                                </div>
                            </div>
                            <form style="margin-top: 50px">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 col-md-offset-2">
                                        <h5 style="text-align: center; margin-bottom: 5px">Masukan kode verifikasi</h5>
                                    </div>
                                </div>
                                <div style="text-align: center">
                                    <input id="code1" type="text" name="code1" value="" class="sign-up-form form-code foccus" style="width: 50px; text-align: center;">
                                    <input id="code2" type="text" name="code2" value="" class="sign-up-form form-code" style="width: 50px; text-align: center;">
                                    <input id="code3" type="text" name="code3" value="" class="sign-up-form form-code" style="width: 50px; text-align: center;">
                                    <input id="code4" type="text" name="code4" value="" class="sign-up-form form-code" style="width: 50px; text-align: center;">
                                    <span id="code-kosong" class="helper-text" style="color: red; display: none;"><i>Masukan kode dengan benar</i></span>
                                    <span id="code-invalid" class="helper-text" style="color: red; display: none;"><i>Kode verifikasi yang anda masukan salah</i></span>
                                </div>
                                <div style="text-align: center">
                                    <button type="button" class="resend-link"><u>Kirim ulang kode verifikasi</u></button>
                                    <h5 id="resend-loading" class="resend-loading"><i class="far fa-spinner fa-spin" style="margin-right: 5px;"></i>Mengirim ulang kode verifikasi</h5>
                                </div>
                                <div class="sign-up" style="margin-top: 50px; margin-bottom: 50px; text-align: center">
                                    <button type="button" id="submit-verifikasi" class="submit-register"><h5><i id="submit-loading" class="fas fa-spinner fa-spin" style="margin-right: 5px; display: none;"></i>VERIFIKASI</h5></button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="clearfix"></div>
                    </div>`
    }

    setNewPass(){
        return `<div class="login">
                    <div class="login-right">
                        <h3>Create New Password</h3>
                        <form id="form-sign-in">
                            <div class="sign-in">
                                <h4>Password baru :</h4>
                                <input id="new-pass" type="password" class="" style="color: black">
                            </div>
                            <div class="sign-in">
                                <h4>Konfirmasi password :</h4>
                                <input id="confirm-new-pass" type="password" class="" style="color: black">
                                <span id="confirm-new-pass-invalid" class="helper-text"
                                    style="color: red; display: none;"><i>Password tidak sesuai</i></span>
                            </div>
                            <div class="sign-in">
                                <button id="btn-save-password" class="btn-sign-in" type="button"><i
                                        id="save-password-loading" class="far fa-spinner fa-spin"
                                        style="margin-right: 5px; display: none;"></i>SUBMIT PASSWORD</button>
                            </div>
                        </form>
                    </div>
                    <br>
                    <div class="clearfix"></div>
                </div>`
    }

    fpFinish(){
        return `<div class="login">
                    <div class="login-bottom" style="margin-top: 50px;">
                        <form style="margin-top: 50px">
                            <div style="text-align: center">
                                <h5 class=""><i class="far fa-check" style="margin-right: 5px;"></i>PASSWORD BARU ANDA BERHASIL DISIMPAN</h5>
                            </div>
                        </form>
                    </div>
                    <div style="display: flex; justify-content: center;">
                        <p id="login-now" style="color: coral; cursor: pointer; width: max-content;">Login sekarang</p>
                    </div>
                    <br><br>
                    <div class="clearfix"></div>
                </div>`
    }
}

const fpComponent = new forgetPasswordComponent