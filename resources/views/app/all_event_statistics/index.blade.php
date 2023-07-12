@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
             <div class="col-md-6"><h2>Statistics</h2></div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                @can('create', App\Models\EventStatistics::class)
                <a
                    href="{{ route('all-event-statistics.create') }}"
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
            <div class="table-responsive">
                <table id="example"
                    class="table table-striped data-table"
                    style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.event_statistics.inputs.games_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.event_statistics.inputs.players_id')
                            </th>
                            <th class="text-right">
                                @lang('crud.event_statistics.inputs.points')
                            </th>
                            <th class="text-right">
                                @lang('crud.event_statistics.inputs.rebounds')
                            </th>
                            <th class="text-right">
                                @lang('crud.event_statistics.inputs.assists')
                            </th>
                            <th class="text-right">
                                @lang('crud.event_statistics.inputs.blocks')
                            </th>
                            <th class="text-right">
                                @lang('crud.event_statistics.inputs.steals')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allEventStatistics as $eventStatistics)
                        <tr>
                            <td>
                                {{ optional($eventStatistics->games)->location
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($eventStatistics->players)->id ??
                                '-' }}
                            </td>
                            <td>{{ $eventStatistics->points ?? '-' }}</td>
                            <td>{{ $eventStatistics->rebounds ?? '-' }}</td>
                            <td>{{ $eventStatistics->assists ?? '-' }}</td>
                            <td>{{ $eventStatistics->blocks ?? '-' }}</td>
                            <td>{{ $eventStatistics->steals ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $eventStatistics)
                                    <a
                                        href="{{ route('all-event-statistics.edit', $eventStatistics) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-info"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $eventStatistics)
                                    <a
                                        href="{{ route('all-event-statistics.show', $eventStatistics) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-success mx-3"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $eventStatistics)
                                    <form
                                        action="{{ route('all-event-statistics.destroy', $eventStatistics) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-danger text-light"
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
                            <td colspan="8">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                {!! $allEventStatistics->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
