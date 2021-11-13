@extends('layout.private') 


@section('content')

    <h1 class="h3 mb-3 text-gray-800">Tambah Pengguna Baru</h1>

    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Isikan maklumat pengguna baru</h6>
    </div>
    <div class="card-body">

        <form action="{{ route('user.store') }}" method="post">
            @csrf

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old( 'name' ) }}">
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old( 'email' ) }}">
                    @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror

                </div>
            </div>


            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="">
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Sahkan Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="">
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror

                </div>
            </div>

            <a href="/admin/user" class="btn btn-secondary btn-lg">Batal</a>

            <button class="btn btn-lg btn-primary">Simpan</button>

        </form>

    </div>
</div>

@endsection 