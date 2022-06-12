@component('mail::message')

Ini adalah kode verifikasi untuk akun anda : <br><br>
<p style="text-align: center; font-size: 35px;"><b>{{ $mail_data['code'] }}</b></p><br>

@endcomponent
