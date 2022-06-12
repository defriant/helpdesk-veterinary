@extends('layouts.user_ui')
@section('content')

<head>
    <style>
        .foccus{
            border: 1px solid orange !important;
        }
    </style>
</head>
    
<div class="regis-content">
    <div class="container">
        <div id="alert-resend" class="alert alert-success alert-dismissable" style="margin-bottom: 35px; display: none;">
            <h5 style="text-align: center"><i class="fas fa-check"></i>&nbsp;&nbsp; Berhasil mengirim ulang kode verifikasi</h5>
        </div>
        <h3 style="text-align: center; color: orange;">VERIFIKASI EMAIL</h3>
        <div class="login">
            <div class="login-bottom" style="margin-top: 50px;">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-md-offset-2">
                        <h5 style="text-align: center">Kode verifikasi telah dikirim ke email</h5>
                        <h5 style="margin-top: 10px; text-align: center;"><i><b>{{ $email }}</b></i></h5>
                    </div>
                </div>
                <form id="form-verifikasi" action="/register-add" method="POST" style="margin-top: 50px">
                    {{ csrf_field() }}
                    <input id="regis-id" type="hidden" name="id" value="{{ $id }}">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-md-offset-2">
                            <h5 style="text-align: center; margin-bottom: 5px">Masukan kode verifikasi</h5>
                        </div>
                    </div>
                    <div style="text-align: center">
                        <input id="code1" type="text" name="code1" value="" class="sign-up-form form-code foccus" style="width: 50px; text-align: center;" autofocus>
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
        </div>
    </div>
</div>

@endsection