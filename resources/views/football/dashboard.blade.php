@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4>Welcome {{ Auth::user()->name }}
                </h4>
                <h3>Moccu {{$title}} Management</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body py-5">Teams {{ $teams ?? '0' }}</div>
                    <a href="{{ url($url.'/Teams') }}" class="card-footer d-flex link">
                        View Teams
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-warning text-dark h-100">
                    <div class="card-body py-5">Players {{ $players ?? '0' }}<sup style="font-size: 20px"></sup>
                    </div>
                    <a href="{{ url($url.'/Players') }}" class="card-footer d-flex link">
                        View Players
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-success text-white h-100">
                    <div class="card-body py-5">Coaches {{ $coaches ?? '-' }}</div>
                    <a href="{{ url($url.'/Coachers') }}" class="card-footer d-flex link">
                        View Coaches
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-danger text-white h-100">
                    <div class="card-body py-5">Tournaments {{ $tournaments ?? '-' }}</div>
                    <a href="{{ url($url.'/Tournaments') }}" class="card-footer d-flex link">
                        View Details
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <span><i class="bi bi-table me-2"></i></span>Latest games ( Fixture )
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Home team</th>
                                        <th>Away Team</th>
                                        <th>Arena</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($games as $game)
                                        <tr>
                                            <td> {{ $game->homeTeam->name ?? '-' }} </td>
                                            <td>{{ $game->awayTeam->name ?? '-' }} </td>
                                            <td>{{ $game->location ?? '-' }} </td>
                                            <td>-no-result </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No games yet</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
