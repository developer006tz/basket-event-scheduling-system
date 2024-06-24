<!-- create team view  -->
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Add new Teams</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                    <a href="{{ url($url) }}" class="btn btn-primary">
                        <i class="icon ion-md-add"></i> Go to dashboard
                    </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
           <!-- handle form here  -->
           <div class="row">
            <div class="col-sm-6 mx-auto">
            <form action="{{ url($url.'/Team/Create') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Team Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="short_name">Team Short Name</label>
                    <input type="text" class="form-control" id="short_name" name="short_name">
                </div>
                <div class="form-group mb-3">
                    <label for="coach_id">Team Coach</label>
                    <select name="coach_id" class="form-select" id="coach_id">
                        <option value="">__select_coach__</option>
                        @foreach ($coaches as $coach )
                        <option value="{{$coach->id}}">{{$coach->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="badge">Team Badge (logo)</label>
                    <input type="file" accept=".png,.jpg,.webp,.jpeg" class="form-control" id="badge" name="badge">
                </div>
                <div class="form-group mb-3">
                    <label for="venue_id">Team Venue</label>
                    <select name="venue_id" class="form-select" id="venue_id">
                        <option value="">__select_team_venue__</option>
                        @foreach ($venues as $venue )
                        <option value="{{$venue->id}}">{{$venue->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
           </div>
        </div>
    </div>
</div>
@endsection