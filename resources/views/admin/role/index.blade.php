@extends('layout.private')


@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1 class="h3 mb-2 text-gray-800">Senarai Peranan Pengguna</h1>

    <a href="/admin/role/create" class="btn btn-secondary">Tambah Peranan</a>
</div>


@if( session('success') ) 
    <div class="alert alert-success">{!! session('success') !!}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Senarai Peranan Pengguna</h6>
    </div>
    <div class="card-body">
        <table class="table table-stripe">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAMA</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>
                        <a href="{{ route('role.edit', $role->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                
                        <form method="post" class="d-inline" 
                        action="{{ route('role.destroy', $role->id) }}"
                        onsubmit="return confirm('Are you sure you want to delete {{$role->name}} ({{$role->id}})?');" >
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>



@endsection 