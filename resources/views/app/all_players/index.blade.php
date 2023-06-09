@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="searchbar mt-0 mb-4">
        <div class="row ">
             <div class="col-md-6"><h2>Players</h2></div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                @can('create', App\Models\Players::class)
                <a
                    href="{{ route('all-players.create') }}"
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
                                @lang('crud.players.inputs.user_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.players.inputs.team_id')
                            </th>
                            <th class="text-right">
                                @lang('crud.players.inputs.jersey_number')
                            </th>
                            <th class="text-right">
                                @lang('crud.players.inputs.height')
                            </th>
                            <th class="text-right">
                                @lang('crud.players.inputs.weight')
                            </th>
                            <th class="text-right">
                                @lang('crud.players.inputs.age')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allPlayers as $players)
                        <tr>
                            <td>{{ optional($players->user)->name ?? '-' }}</td>
                            <td>
                                {{ optional($players->teams)->name ?? '-' }}
                            </td>
                            <td>{{ $players->jersey_number ?? '-' }}</td>
                            <td>{{ $players->height ?? '-' }}</td>
                            <td>{{ $players->weight ?? '-' }}</td>
                            <td>{{ $players->age ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $players)
                                    <a
                                        href="{{ route('all-players.edit', $players) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $players)
                                    <a
                                        href="{{ route('all-players.show', $players) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-success mx-3"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $players)
                                    <form
                                        action="{{ route('all-players.destroy', $players) }}"
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
                            <td colspan="7">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">{!! $allPlayers->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
