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

                <button class="btn btn-warning" data-toggle="modal" data-target="#loginOrRegister-modal">
                    Langgan Sekarang
                </button>
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

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Daftar</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
@endsection
