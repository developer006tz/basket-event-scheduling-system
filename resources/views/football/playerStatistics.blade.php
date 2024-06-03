@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Player Statistics</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url('football/Player/Statistics/Create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Create New Player Statistics
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
                            <th>Tournament</th>
                            <th>Player</th>
                            <th>Game</th>
                            <th>Goals</th>
                            <th>Assists</th>
                            <th>Yellow Cards</th>
                            <th>Red Cards</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($playerStatistics as $stat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $stat->tournament->name }}</td>
                            <td>{{ $stat->player->name }}</td>
                            <td>{{ $stat->game->homeTeam->name }} vs {{ $stat->game->awayTeam->name }}</td>
                            <td>{{ $stat->goals }}</td>
                            <td>{{ $stat->assist }}</td>
                            <td>{{ $stat->yellow_card }}</td>
                            <td>{{ $stat->red_card }}</td>
                            <td class="text-center">
                                <a href="{{ url("football/Player/Statistics/Update?playerStatistics_id=$stat->id") }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url("football/Player/Statistics/Delete?playerStatistics_id=$stat->id") }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete these statistics?')">Delete</a>
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
