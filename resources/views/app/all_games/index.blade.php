@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
              <div class="col-md-6"><h2>Games</h2></div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                @can('create', App\Models\Games::class)
                
                <form method="POST"
                action="{{ route('all-games.generate') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary"><i class="icon ion-md-add"></i> Generate</button>
                </form>

                <a
                    href="{{ route('all-games.create') }}"
                    class="btn btn-primary mx-3"
                >
                    <i class="icon ion-md-add "></i> @lang('crud.common.create')
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
                                @lang('crud.games.inputs.home_team_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.games.inputs.away_team_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.games.inputs.location')
                            </th>
                            <th class="text-left">
                                @lang('crud.games.inputs.date')
                            </th>
                            <th class="text-left">
                                @lang('crud.games.inputs.start_time')
                            </th>
                             <th class="text-left">
                                @lang('crud.all_games.inputs.result')
                            </th>
                            <th class="text-left">
                                @lang('crud.all_games.inputs.result_status')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allGames as $games)
                        <tr>
                            <td>{{ $games->homeTeam->name ?? '-' }}</td>
                            <td>{{ $games->awayTeam->name ?? '-' }}</td>
                            <td>{{ $games->location ?? '-' }}</td>
                            <td>{{ $games->date ?? '-' }}</td>
                            <td>{{ $games->start_time ?? '-' }}</td>
                            <td>{{ $games->result ?? '-' }}</td>
                            <td>{{ $games->result_status ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $games)
                                    <a
                                        href="{{ route('all-games.edit', $games) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $games)
                                    <a
                                        href="{{ route('all-games.show', $games) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-success mx-3"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $games)
                                    <form
                                        action="{{ route('all-games.destroy', $games) }}"
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
                            <td colspan="6">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">{!! $allGames->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
