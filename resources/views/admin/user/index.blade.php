@extends('layout.private')


@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1 class="h3 mb-2 text-gray-800">Senarai Pengguna</h1>

    <a href="/admin/user/create" class="btn btn-secondary">Tambah Pengguna</a>
</div>


@if( session('success') ) 
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        {{ $users->links() }}

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-danger">DELETE</a>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }}

        </div>
    </div>
</div>

@endsection
