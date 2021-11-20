@extends('layout.public')

@section('content')

<h2>Pendaftaran</h2>
<p>Sila pilih pelan langganan</p>

<div class="row">
    @foreach($plans as $plan)
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                <h4>{{ $plan->name }}</h4>
                <h5>RM {{ number_format( ($plan->price / 100), 2 ) }}</h5>
                <p class="mb-5"><strong>Tempoh :</strong> {{ $plan->duration }} hari</p>


                @auth 
            <a href="/signup/review/{{ $plan->id }}" class="plan-button btn btn-warning">
                Langgan Sekarang
            </a>
            @endauth 


                @guest 
                <button data-plan-id="{{$plan->id}}" class="plan-button btn btn-warning" data-toggle="modal" data-target="#loginOrRegister-modal">
                    Langgan Sekarang
                </button>

                @endguest
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="loginOrRegister-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sila login atau daftar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Sila login atau daftar sebelum membuat bayaran.</p>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login-form" role="tab" aria-controls="home" aria-selected="true">Login</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register-form" role="tab" aria-controls="profile" aria-selected="false">Daftar</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
    <!-- LOGIN FORM -->
  <div class="tab-pane fade show active" id="login-form" role="tabpanel" aria-labelledby="home-tab">

      <form class="user p-5" id="login-form-form" method="POST" action="{{ route('login') }}">
    @csrf

    <div class="alert alert-danger d-none" id="login-alert">
        Email atau katalaluan tidak sah.
    </div>

    <div class="form-group">
        <input id="login-form-email" class="form-control form-control-user" type="email" name="email" value="{{ old('email') }}" required
            autofocus aria-describedby="emailHelp" placeholder="Enter Email Address..." />
    </div>

    <div class="form-group">
        <input id="login-form-password" class="form-control form-control-user" type="password" name="password" required
            autocomplete="current-password" placeholder="Password" />
    </div>

    <div>
        <button type="button" id="login-button" class="btn btn-primary btn-user btn-block">
            {{ __('Login') }}
        </button>
    </div>


    <hr>

    @if (Route::has('password.request'))

    <div class="text-center">
        <a class="small" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
        </a>
    </div>

    @endif

</form>

  </div>



    <!-- REGISTER FORM -->
  <div class="tab-pane fade" id="register-form" role="tabpanel" aria-labelledby="profile-tab">


  <form method="POST" class="user p-5" action="{{ route('register') }}">
        @csrf

        <div class="alert alert-danger d-none" id="register-alert">
        Sila semak borang pendaftaran.
    </div>



        <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input class="form-control form-control-user" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" id="register-form-name" placeholder="Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-user"  type="email" name="email" value="{{ old('email') }}" id="register-form-email"  required placeholder="Email">
                                    </div>
        </div>

        <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input class="form-control form-control-user" type="password" name="password" required autocomplete="new-password" id="register-form-password"  placeholder="Password" >
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-user" type="password" name="password_confirmation" required autocomplete="new-password" id="register-form-password-confirmation"  placeholder="Confirm Password">
                                    </div>
        </div>

        <div>

            <button type="button" id="register-button" class="btn btn-primary btn-user btn-block">
                {{ __('Register') }}
            </button>

        </div>

    </form>

      
  </div>
</div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')
<script src="/js/signup.js"></script>
@endsection
