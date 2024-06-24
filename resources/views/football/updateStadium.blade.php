<!-- update stadium view  -->
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Update Stadium</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url('football/Stadium') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Go to Stadium List
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <form action="{{ url('football/Stadium/Update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="stadium_id" value="{{ $stadium->id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Stadium Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $stadium->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="number" name="capacity" id="capacity" class="form-control" value="{{ $stadium->capacity }}">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" {{ $stadium->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="maintenance" {{ $stadium->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="unused" {{ $stadium->status == 'unused' ? 'selected' : '' }}>Unused</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
