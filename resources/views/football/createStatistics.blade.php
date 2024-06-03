@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Add New Statistics</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url($url.'/Team/Statistics') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Go to Statistics List
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <form action="{{ url($url.'/Team/Statistics/Create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="tournament_id" class="form-label">Tournament</label>
                            <select name="tournament_id" id="tournament_id" class="form-control" required>
                                @foreach($tournaments as $tournament)
                                    <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="team_id" class="form-label">Team</label>
                            <select name="team_id" id="team_id" class="form-control" required>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="game_id" class="form-label">Game</label>
                            <select name="game_id" id="game_id" class="form-control" required>
                                @foreach($games as $game)
                                    <option value="{{ $game->id }}">{{ $game->homeTeam->name }} vs {{ $game->awayTeam->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="goals_scored" class="form-label">Goals Scored</label>
                            <input type="number" class="form-control" id="goals_scored" name="goals_scored">
                        </div>
                        <div class="mb-3">
                            <label for="goals_conceded" class="form-label">Goals Conceded</label>
                            <input type="number" class="form-control" id="goals_conceded" name="goals_conceded">
                        </div>
                        <div class="mb-3">
                            <label for="game_status" class="form-label">Game Status</label>
                            <select name="game_status" id="game_status" class="form-control">
                                <option value="scheduled">Scheduled</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
