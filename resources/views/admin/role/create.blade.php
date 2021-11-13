@extends('layout.private') 

@section('content')

    <h1 class="h3 mb-3 text-gray-800">Tambah Peranan Baru</h1>

    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Berikan nama untuk peranan baru</h6>
    </div>
    <div class="card-body">

        <form action="{{ route('role.store') }}" method="post">
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


            <a href="/admin/role" class="btn btn-secondary btn-lg">Batal</a>

            <button type="submit" class="btn btn-lg btn-primary">Simpan</button>

        </form>

    </div>
</div>

@endsection 