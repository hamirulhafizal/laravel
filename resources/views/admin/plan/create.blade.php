@extends('layout.private') 

@section('content')

    <h1 class="h3 mb-3 text-gray-800">Tambah Pelan Baru</h1>

    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Isikan maklumat untuk pelan langganan baru</h6>
    </div>
    <div class="card-body">

        <form action="{{ route('plan.store') }}" method="post">
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
                <label class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="number" 
                    min="1"
                    max="99999"
                    step="0.01"
                    class="form-control @error('price') is-invalid @enderror" 
                    name="price" value="{{ old( 'price' ) }}">
                    @error('price')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Tempoh</label>
                <div class="col-sm-10">
                    <input type="number" 
                    min="1"
                    max="99999"
                    step="1"
                    class="form-control @error('duration') is-invalid @enderror" 
                    name="duration" value="{{ old( 'duration' ) }}">
                    @error('duration')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>


            <a href="/admin/plan" class="btn btn-secondary btn-lg">Batal</a>

            <button type="submit" class="btn btn-lg btn-primary">Simpan</button>

        </form>

    </div>
</div>

@endsection 