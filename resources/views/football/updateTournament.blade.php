@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Update  Tournament</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url('football') }}" class="btn btn-primary">
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
                    <form method="POST" action="{{ url($url.'/Tournaments/Update') }}">
                    @method('PATCH')
                        @csrf
                        <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tournament Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $tournament->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control" id="year" name="year"
                                value="{{ $tournament->year }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="{{ $tournament->start_date ?? '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="{{ $tournament->end_date ?? '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="first_winner_award" class="form-label">First Winner Award</label>
                            <input type="text" class="form-control" id="first_winner_award"
                                name="first_winner_award" value="{{ $tournament->first_winner_award ?? '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="second_winner_award" class="form-label">Second Winner Award</label>
                            <input type="text" class="form-control" id="second_winner_award"
                                name="second_winner_award" value="{{ $tournament->second_winner_award ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="third_winner_award" class="form-label">Third Winner Award</label>
                            <input type="text" class="form-control" id="third_winner_award"
                                name="third_winner_award" value="{{ $tournament->third_winner_award ??'' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection