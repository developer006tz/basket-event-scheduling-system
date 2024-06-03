@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Teams</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                    <a href="{{ url('football/Team/Create') }}" class="btn btn-primary">
                        <i class="icon ion-md-add"></i> Add team
                    </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-left">
                                Team Name
                            </th>
                            <th class="text-left">
                              Short Name
                            </th>
                            <th class="text-left">
                                Coach
                            </th>
                            <th class="text-left">
                                Badge
                            </th>
                            <th class="text-center">
                               Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teams as $team)
                        <td>{{$loop->iteration}}</td>
                        <td>{{$team->name}}</td>
                        <td>{{$team->short_name}}</td>
                        <td>{{$team->coach->name ?? ''}}</td>
                        <td>
                            <img src="{{asset("uploads/$team->badge")}}" alt="team-badge">
                        </td>
                        <td>
                            <a href="{{url("football/Team/edit?team_id=$team->id")}}" class="btn btn-primary">edit</a>
                            <a href="{{url("football/Team/delete?team_id=$team->id")}}" class="btn btn-danger">delete</a>
                        </td>
                        @empty 
                        <tr>
                            <td colspan="5" class="text-center">
                                <img src="{{asset('/empty.png')}}" alt="empty">
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