@extends('layout.public')

@section('content')

<h2>Review</h2>

<p>Nama : {{ $user->name }}</p>
<p>Email : {{ $user->email }}</p>
<p>Anda akan membuat bayaran untuk pelan berikut :</p>
<div class="card shadow mb-3">
    <div class="card-body">
        <h5>Pelan {{ $plan->name }}</h5>
        <p>Tempoh : {{ $plan->duration }}</p>
        <p>{{ $plan->money_price }}</p>
    </div>
</div>

<h4>Kaedah Bayaran</h4>

<form action="{{ route('signup.go', 'securepay') }}" method="post">
    @csrf 
    <input type="hidden" name="plan_id" value="{{$plan->id}}">
    <label for="buyer_phone">Nombor Telefon</label>

    <input type="text" name="buyer_phone" class="form-control mb-3">
<button type="submit" href="/signup/go/securepay/{{$plan->id}}" class="btn btn-primary">
    SecurePay
</button>
</form>

@endsection