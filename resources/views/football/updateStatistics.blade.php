@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Update Statistics</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url('football/Team/Statistics') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Go to Statistics List
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <form method="POST" action="{{ url('football/Team/Statistics/Update') }}">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="statistics_id" value="{{ $statistics->id }}">
                        <div class="mb-3">
                            <label for="tournament_id" class="form-label">Tournament</label>
                            <select name="tournament_id" id="tournament_id" class="form-control" required>
                                @foreach($tournaments as $tournament)
                                    <option value="{{ $tournament->id }}" {{ $tournament->id == $statistics->tournament_id ? 'selected' : '' }}>{{ $tournament->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="team_id" class="form-label">Team</label>
                            <select name="team_id" id="team_id" class="form-control" required>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ $team->id == $statistics->team_id ? 'selected' : '' }}>{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="game_id" class="form-label">Game</label>
                            <select name="game_id" id="game_id" class="form-control" required>
                                @foreach($games as $game)
                                    <option value="{{ $game->id }}" {{ $game->id == $statistics->game_id ? 'selected' : '' }}>{{ $game->homeTeam->name }} vs {{ $game->awayTeam->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="goals_scored" class="form-label">Goals Scored</label>
                            <input type="number" class="form-control" id="goals_scored" name="goals_scored" value="{{ $statistics->goals_scored }}">
                        </div>
                        <div class="mb-3">
                            <label for="goals_conceded" class="form-label">Goals Conceded</label>
                            <input type="number" class="form-control" id="goals_conceded" name="goals_conceded" value="{{ $statistics->goals_conceded }}">
                        </div>
                        <div class="mb-3">
                            <label for="game_status" class="form-label">Game Status</label>
                            <select name="game_status" id="game_status" class="form-control">
                                <option value="scheduled" {{ $statistics->game_status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="ongoing" {{ $statistics->game_status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="completed" {{ $statistics->game_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="canceled" {{ $statistics->game_status == 'canceled' ? 'selected' : '' }}>Canceled</option>
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
