@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-players.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.players.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.players.inputs.user_id')</h5>
                    <span>{{ optional($players->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.players.inputs.teams_id')</h5>
                    <span>{{ optional($players->teams)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.players.inputs.jersey_number')</h5>
                    <span>{{ $players->jersey_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.players.inputs.height')</h5>
                    <span>{{ $players->height ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.players.inputs.weight')</h5>
                    <span>{{ $players->weight ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.players.inputs.age')</h5>
                    <span>{{ $players->age ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-players.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Players::class)
                <a
                    href="{{ route('all-players.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
