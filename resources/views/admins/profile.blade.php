@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Admin</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url('admins') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Go to Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <form method="POST" action="{{ url('admins/update') }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="admin_id" value="{{ $admin->id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}"  >
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}"  >
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $admin->phone }}">
                        </div>
                        <div class="mb-3">
                            <label for="maritial_status" class="form-label">Maritial Status</label>
                            <select class="form-control" id="maritial_status" name="maritial_status">
                                <option value="single" {{ $admin->maritial_status == 'single' ? 'selected' : '' }}>Single</option>
                                <option value="maried" {{ $admin->maritial_status == 'maried' ? 'selected' : '' }}>Maried</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $admin->address }}">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if($admin->image)
                                <img src="{{ asset('uploads/' . $admin->image) }}" alt="Admin Image" width="100" class="mt-2">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="form-text text-muted">Leave blank if you do not want to change the password</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
