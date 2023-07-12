@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
              <div class="col-md-6"><h2>Teams</h2></div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                @can('create', App\Models\Teams::class)
                <a
                    href="{{ route('all-teams.create') }}"
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
                                @lang('crud.teams.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.teams.inputs.coaches_id')
                            </th>
                            <th class="text-left">
                                Logo
                            </th>
                            <th class="text-left">
                                @lang('crud.teams.inputs.location')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allTeams as $teams)

                        <tr>
                            <td>{{ $teams->name ?? '-' }}</td>
                            <td>{{ $teams->coaches->user->name ?? '-' }}</td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $teams->image ? \Storage::url($teams->image) : '' }}"
                                />
                            </td>
                            <td>{{ $teams->location ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $teams)
                                    <a
                                        href="{{ route('all-teams.edit', $teams) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $teams)
                                    <a
                                        href="{{ route('all-teams.show', $teams) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-success mx-3"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $teams)
                                    <form
                                        action="{{ route('all-teams.destroy', $teams) }}"
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
                            <td colspan="5">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">{!! $allTeams->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
