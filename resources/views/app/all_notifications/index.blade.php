@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
             <div class="col-md-6"></div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Notifications::class)
                <a
                    href="{{ route('all-notifications.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.notifications.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.notifications.inputs.games_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.notifications.inputs.practices_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.notifications.inputs.event_types_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.notifications.inputs.title')
                            </th>
                            <th class="text-left">
                                @lang('crud.notifications.inputs.message')
                            </th>
                            <th class="text-left">
                                @lang('crud.notifications.inputs.sent_at')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allNotifications as $notifications)
                        <tr>
                            <td>
                                {{ optional($notifications->games)->location ??
                                '-' }}
                            </td>
                            <td>
                                {{ optional($notifications->practices)->location
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($notifications->eventTypes)->name ??
                                '-' }}
                            </td>
                            <td>{{ $notifications->title ?? '-' }}</td>
                            <td>{{ $notifications->message ?? '-' }}</td>
                            <td>{{ $notifications->sent_at ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $notifications)
                                    <a
                                        href="{{ route('all-notifications.edit', $notifications) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $notifications)
                                    <a
                                        href="{{ route('all-notifications.show', $notifications) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $notifications)
                                    <form
                                        action="{{ route('all-notifications.destroy', $notifications) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                {!! $allNotifications->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
