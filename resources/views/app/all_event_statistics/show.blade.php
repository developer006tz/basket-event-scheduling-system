@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-event-statistics.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.event_statistics.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.event_statistics.inputs.games_id')</h5>
                    <span
                        >{{ optional($eventStatistics->games)->location ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.event_statistics.inputs.players_id')</h5>
                    <span
                        >{{ optional($eventStatistics->players)->id ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.event_statistics.inputs.points')</h5>
                    <span>{{ $eventStatistics->points ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.event_statistics.inputs.rebounds')</h5>
                    <span>{{ $eventStatistics->rebounds ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.event_statistics.inputs.assists')</h5>
                    <span>{{ $eventStatistics->assists ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.event_statistics.inputs.blocks')</h5>
                    <span>{{ $eventStatistics->blocks ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.event_statistics.inputs.steals')</h5>
                    <span>{{ $eventStatistics->steals ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-event-statistics.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\EventStatistics::class)
                <a
                    href="{{ route('all-event-statistics.create') }}"
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
