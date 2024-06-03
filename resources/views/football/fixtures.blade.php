@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Fixtures</h2>
            </div>
           
        </div>
    </div>
    <div class="card my-3">
        <div class="card-body">
        <div class="col-sm-12 ">
                <form action="{{ url($url.'/Fixtures/Generate') }}"  method="POST">
                    @csrf
                    <div class=" row d-flex flex-row  justify-content-even">
                    <div class="form-group col-sm-6">
                        <select name="tournament_id" class="form-control" required>
                            <option value="">_select_tournament_</option>
                            @foreach($tournaments as $tournament)
                                <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                       <button type="submit" class="btn btn-primary ml-2">
                        <i class="icon ion-md-add"></i> Generate Fixtures
                    </button> 
                    </div>

                    </div>
                    
                    
                </form>
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
                            <th>Home Team</th>
                            <th>Away Team</th>
                            <th>Venue</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>Results</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $colors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-info', 'bg-secondary'];
                            $colorIndex = 0;
                        @endphp
                        @foreach($tournaments as $tournament)
                            @php
                                $tournamentColor = $colors[$colorIndex % count($colors)];
                                $colorIndex++;
                            @endphp
                            <tr>
                                <td colspan="8" class="text-center {{ $tournamentColor }} text-white">
                                    {{ $tournament->name }}
                                </td>
                            </tr>
                            @foreach($tournament->games as $game)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="{{ $tournamentColor }}">{{ $tournament->name }}</td>
                                    <td>{{ $game->homeTeam->name }}</td>
                                    <td>{{ $game->awayTeam->name }}</td>
                                    <td>{{ $game->venue->name }}</td>
                                    <td>{{ $game->date->format(date('d-m-y')) }}</td>
                                    <td>{{ $game->start_time }}</td>
                                    <td class="text-center text-danger">
                                        Not started
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
