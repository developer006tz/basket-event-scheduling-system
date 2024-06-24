@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Add New Coach</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url($url) }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Go to Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="card">
    <div class="card-header">
            @include('error')
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <form action="{{ url($url.'/Coacher/Create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Coach Name</label>
                            <input type="text" class="form-control" id="name" name="name"  >
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"  >
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"  >
                        </div>
                        <div class="mb-3">
                            <label for="course_id" class="form-label">Course</label>
                            <select name="course_id" class="form-select" id="course_id">
                                <option value="">__select_Coacher_Course__</option>
                                @foreach ($courses as $course )
                                <option value="{{$course->id}}">{{$course->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="team_id" class="form-label">Team</label>
                            <select name="team_id" class="form-select" id="team_id">
                                <option value="">__select_Coacher_Team__</option>
                                @foreach ($teams as $team )
                                <option value="{{$team->id}}">{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
