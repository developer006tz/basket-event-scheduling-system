@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Add New Player Statistics</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url($url.'/Player/Statistics') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Go to Player Statistics List
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
                    <form action="{{ url($url.'/Player/Statistics/Create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="tournament_id" class="form-label">Tournament</label>
                            <select name="tournament_id" id="tournament_id" class="form-control"  >
                                @foreach($tournaments as $tournament)
                                    <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="player_id" class="form-label">Player</label>
                            <select name="player_id" id="player_id" class="form-control"  >
                                @foreach($players as $player)
                                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="game_id" class="form-label">Game</label>
                            <select name="game_id" id="game_id" class="form-control"  >
                                @foreach($games as $game)
                                    <option value="{{ $game->id }}">{{ $game->homeTeam->name }} vs {{ $game->awayTeam->name .' -played on >'. $game->date->format(date('d-m-y'))}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="goals" class="form-label">Goals</label>
                            <input type="number" name="goals" id="goals" class="form-control"  >
                        </div>
                        <div class="mb-3">
                            <label for="assist" class="form-label">Assists</label>
                            <input type="number" name="assist" id="assist" class="form-control"  >
                        </div>
                        <div class="mb-3">
                            <label for="yellow_card" class="form-label">Yellow Cards</label>
                            <input type="number" name="yellow_card" id="yellow_card" class="form-control"  >
                        </div>
                        <div class="mb-3">
                            <label for="red_card" class="form-label">Red Cards</label>
                            <input type="number" name="red_card" id="red_card" class="form-control"  >
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
