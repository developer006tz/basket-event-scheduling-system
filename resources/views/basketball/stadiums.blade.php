@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Basket Stadiums</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url($url.'/Stadium/Create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Create New Stadium
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Capacity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stadiums as $stadium)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $stadium->name }}</td>
                            <td>{{ $stadium->capacity }}</td>
                            <td>{{ ucfirst($stadium->status) }}</td>
                            <td class="text-center">
                                <a href="{{ url("$url/Stadium/Update?stadium_id=$stadium->id") }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url("$url/Stadium/Delete?stadium_id=$stadium->id") }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this stadium?')">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
