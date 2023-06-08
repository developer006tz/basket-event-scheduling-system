@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-notifications.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.notifications.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.notifications.inputs.games_id')</h5>
                    <span
                        >{{ optional($notifications->games)->location ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.notifications.inputs.practices_id')</h5>
                    <span
                        >{{ optional($notifications->practices)->location ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.notifications.inputs.event_types_id')</h5>
                    <span
                        >{{ optional($notifications->eventTypes)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.notifications.inputs.title')</h5>
                    <span>{{ $notifications->title ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.notifications.inputs.message')</h5>
                    <span>{{ $notifications->message ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.notifications.inputs.sent_at')</h5>
                    <span>{{ $notifications->sent_at ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-notifications.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Notifications::class)
                <a
                    href="{{ route('all-notifications.create') }}"
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
