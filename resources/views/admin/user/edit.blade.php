@extends('layout.private')


@section('content')

<h1 class="h3 mb-3 text-gray-800">Edit Pengguna</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $user->name }}</h6>
    </div>
    <div class="card-body">

        <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            @method('put')

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old( 'name', $user->name ) }}">
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old( 'email', $user->email ) }}">
                    @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Peranan</label>
                <div class="col-sm-10">
                    @foreach($roles as $role)

                    <div class="custom-control custom-checkbox small">
                        <input  
                            @if( in_array($role->id, $user->roles->pluck('id')->toArray() ))
                                checked
                            @endif
                        type="checkbox" class="custom-control-input" 
                        name="roles[]" value="{{$role->id}}" id="role_{{$role->id}}">
                        <label class="custom-control-label" for="role_{{$role->id}}">{{$role->name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <button class="btn btn-lg btn-primary">Simpan</button>

        </form>

    </div>
</div>


@endsection