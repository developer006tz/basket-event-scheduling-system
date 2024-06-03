@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Admin Users</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url('admins/create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Create New Admin
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Maritial Status</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>{{ $admin->maritial_status }}</td>
                            <td>{{ $admin->address }}</td>
                            <td class="text-center">
                                <a href="{{ url("admins/update?admin_id=$admin->id") }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url("admins/delete?admin_id=$admin->id") }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Admin?')">Delete</a>
                            </td>
                        </tr>
                        @empty 
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('/empty.png') }}" alt="empty">
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
