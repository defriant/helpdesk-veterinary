@extends('layouts.user_ui')
@section('content')

<div class="checkout">
    <div class="container">
        <h3 style="color: orange">Keranjang Belanja</h3>
        <div id="keranjang-data">
            @include('user.keranjang-data')
        </div>
    </div>
</div>

@endsection
