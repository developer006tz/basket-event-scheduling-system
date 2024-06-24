@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2> Edit Team | {{$team->name}}</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                    <a href="{{ url($url.'/Teams') }}" class="btn btn-primary">
                        <i class="icon ion-md-add"></i> Manage teams
                    </a>
            </div>
        </div>
    </div>

    <div class="card">
    <div class="card-header">
            @include('error')
        </div>
        <div class="card-body">
           <!-- handle form here  -->
           <div class="row">
            <div class="col-sm-6 mx-auto">
            <form action="{{ url("$url/Team/Update") }}" method="POST" enctype="multipart/form-data" >
               @method('PATCH')
                @csrf
                <input type="hidden" name="team_id" value="{{$team->id}}">
                <div class="form-group mb-3">
                    <label for="name">Team Name</label>
                    <input type="text" class="form-control" id="name" name="name" required value="{{$team->name ?? ''}}">
                </div>
                <div class="form-group mb-3">
                    <label for="short_name">Team Short Name</label>
                    <input type="text" class="form-control" id="short_name" name="short_name" value="{{$team->short_name ?? ''}}">
                </div>
                <div class="form-group mb-3">
                    <label for="coach_id">Team Coach</label>
                    <select name="coach_id" class="form-select" id="coach_id">
                        <option value="">__select_coach__</option>
                        @foreach ($coaches as $coach )
                        <option value="{{$coach->id}}" @selected($coach->id == $team->coach_id) >{{$coach->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="badge">Team Badge (logo)</label>
                    <input type="file" class="form-control" id="badge" accept=".png,.jpg,.webp,.jpeg" name="badge">
                </div>
                <div class="form-group mb-3">
                    <label for="venue_id">Team Venue</label>
                    <select name="venue_id" class="form-select" id="venue_id">
                        <option value="">__select_team_venue__</option>
                        @foreach ($venues as $venue )
                        <option value="{{$venue->id}}" @selected($venue->id == $team->venue_id)>{{$venue->name}}</option>
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