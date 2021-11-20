@extends('layout.private')

@section('content')
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <div>You are logged in!</div>

    @if($subscription !== null) 
    <p><strong>Expire At:</strong> {{$subscription->expire_at}}</p>
    @endif
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit">
            {{ __('Logout') }}
        </button>
    </form>

    <hr>

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
        @include('profile.update-profile-information-form')
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        @include('profile.update-password-form')
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
        @include('profile.two-factor-authentication-form')
    @endif
@endsection
