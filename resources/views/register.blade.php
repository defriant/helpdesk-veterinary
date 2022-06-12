@extends('layouts.user_ui')
@section('content')
    
<div class="regis-content">
    <div class="container">
        <h3 style="text-align: center; color: orange;">DAFTARKAN AKUNMU</h3>
        <div class="login">
            <div class="login-bottom" style="margin-top: 50px;">
                <form id="form-regis" action="/verification" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="sign-up">
                                <h4>Nama :</h4>
                                <input id="nama" type="text" name="nama" value="" class="sign-up-form" placeholder="Nama anda">	
                                <span id="nama-invalid" class="helper-text" style="color: red; display: none;"><i>Nama tidak boleh kosong</i></span>	
                            </div>
                            <div class="sign-up">
                                <h4>No. Telepon :</h4>
                                <input id="telp" type="text" name="telp" value="" class="sign-up-form" placeholder="Nomor Telepon anda">
                                <span id="telp-invalid" class="helper-text" style="color: red; display: none;"><i>No. Telp tidak boleh kosong</i></span>	
                            </div>
                            <div class="sign-up">
                                <h4>Alamat :</h4>
                                <input id="alamat" type="text" name="alamat" value="" class="sign-up-form" placeholder="Alamat tempat tinggal">
                                <span id="alamat-invalid" class="helper-text" style="color: red; display: none;"><i>Alamat tidak boleh kosong</i></span>	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sign-up">
                                <h4>Email :</h4>
                                <input id="email" type="email" name="email" value="" class="sign-up-form" placeholder="Gunakan email aktif">
                                <span id="email-kosong" class="helper-text" style="color: red; display: none;"><i>Email tidak boleh kosong</i></span>
                                <span id="email-invalid" class="helper-text" style="color: red; display: none;"><i>Email sudah terdaftar, gunakan email lain</i></span>	
                            </div>
                            <div class="sign-up">
                                <h4>Password :</h4>
                                <input id="password" type="password" name="password" value="" class="sign-up-form">
                                <span id="password-invalid" class="helper-text" style="color: red; display: none;"><i>Password tidak boleh kosong</i></span>	
                            </div>
                            <div class="sign-up">
                                <h4>Konfirmasi Password :</h4>
                                <input id="konfirm-password" type="password" name="konfirm_password" value="" class="sign-up-form">
                                <span id="konfirm-password-invalid" class="helper-text" style="color: red; display: none;"><i>Password tidak Sesuai</i></span>
                            </div>
                        </div>
                    </div>
                    <div class="sign-up" style="margin-top: 50px; margin-bottom: 50px; text-align: center">
                        <button type="button" id="submit-register" class="submit-register"><h5><i id="submit-loading" class="fas fa-spinner fa-spin" style="margin-right: 5px; display: none;"></i> DAFTAR SEKARANG</h5></button>
                    </div>
                </form>
            </div>
            
            <div class="clearfix"></div>
        </div>
    </div>
</div>

@endsection