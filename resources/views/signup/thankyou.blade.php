@extends('layout.public')


@section('content') 

    <h3>Terima kasih</h3>

    @if($verified) 
        <p>Terima kasih atas pembayaran keahlian yang telah dibuat. Sila login untuk menyemak tarikh luput keahlian yang baru.</p>
    @else 
        <p>Pembayaran anda akan diproses. Sila login untuk menyemak status keahlian.</p>
    @endif 

    <a href="/login" class="btn btn-primary">Login</a>

@endsection