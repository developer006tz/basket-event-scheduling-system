@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Edit Player Statistics</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url('football/Player/Statistics') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Go to Player Statistics List
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <form action="{{ url('football/Player/Statistics/Update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="playerStatistics_id" value="{{ $playerStatistics->id }}">
                        <div class="mb-3">
                            <label for="tournament_id" class="form-label">Tournament</label>
                            <select name="tournament_id" id="tournament_id" class="form-control" required>
                                @foreach($tournaments as $tournament)
                                    <option value="{{ $tournament->id }}" @if($tournament->id == $playerStatistics->tournament_id) selected @endif>{{ $tournament->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="player_id" class="form-label">Player</label>
                            <select name="player_id" id="player_id" class="form-control" required>
                                @foreach($players as $player)
                                    <option value="{{ $player->id }}" @if($player->id == $playerStatistics->player_id) selected @endif>{{ $player->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="game_id" class="form-label">Game</label>
                            <select name="game_id" id="game_id" class="form-control" required>
                                @foreach($games as $game)
                                    <option value="{{ $game->id }}" @if($game->id == $playerStatistics->game_id) selected @endif>{{ $game->homeTeam->name }} vs {{ $game->awayTeam->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="goals" class="form-label">Goals</label>
                            <input type="number" name="goals" id="goals" class="form-control" value="{{ $playerStatistics->goals }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="assist" class="form-label">Assists</label>
                            <input type="number" name="assist" id="assist" class="form-control" value="{{ $playerStatistics->assist }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="yellow_card" class="form-label">Yellow Cards</label>
                            <input type="number" name="yellow_card" id="yellow_card" class="form-control" value="{{ $playerStatistics->yellow_card }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="red_card" class="form-label">Red Cards</label>
                            <input type="number" name="red_card" id="red_card" class="form-control" value="{{ $playerStatistics->red_card }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
