@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Courses</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url('courses/create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Create New Course
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
                            <th>Level</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->level }}</td>
                            <td class="text-center">
                                <a href="{{ url("courses/update?course_id=$course->id") }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url("courses/delete?course_id=$course->id") }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Course?')">Delete</a>
                            </td>
                        </tr>
                        @empty 
                        <tr>
                            <td colspan="4" class="text-center">
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
