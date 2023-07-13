@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-games.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.all_games.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.all_games.inputs.home_team_id')</h5>
                    <span>{{ $games->home_team_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_games.inputs.away_team_id')</h5>
                    <span>{{ $games->away_team_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_games.inputs.location')</h5>
                    <span>{{ $games->location ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_games.inputs.date')</h5>
                    <span>{{ $games->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_games.inputs.start_time')</h5>
                    <span>{{ $games->start_time ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_games.inputs.result')</h5>
                    <span>{{ $games->result ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_games.inputs.result_status')</h5>
                    <span>{{ $games->result_status ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('all-games.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Games::class)
                <a href="{{ route('all-games.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
