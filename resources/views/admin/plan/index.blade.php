@extends('layout.private')


@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1 class="h3 mb-2 text-gray-800">Senarai Pelan Langganan</h1>

    <a href="/admin/plan/create" class="btn btn-secondary">Tambah Pelan</a>
</div>


@if( session('success') ) 
    <div class="alert alert-success">{!! session('success') !!}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Senarai Pelan Langganan</h6>
    </div>
    <div class="card-body">
        <table class="table table-stripe">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAMA</th>
                    <th>HARGA</th>
                    <th>TEMPOH</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>


                @forelse($plans as $plan)
                <tr>
                    <td>{{$plan->id}}</td>
                    <td>{{$plan->name}}</td>
                    <td>{{ $plan->money_price }}</td>
                    <td>{{$plan->duration}}</td>
                    <td>
                        <a href="{{ route('plan.edit', $plan->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                
                        <form method="post" class="d-inline" 
                        action="{{ route('plan.destroy', $plan->id) }}"
                        onsubmit="return confirm('Are you sure you want to delete {{$plan->name}} ({{$plan->id}})?');" >
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                        </form>
                    </td>
                </tr>
                @empty 
                <tr>
                        <td colspan="5" class="text-center" style="height: 50px;">
                            anda belum membuat apa-apa pelan langganan
                        </td>
                    </tr>

                @endforelse
            </tbody>

        </table>
    </div>
</div>



@endsection 