@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
             <div class="col-md-6"><h2>Practises</h2></div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                @can('create', App\Models\Practices::class)
                <a
                    href="{{ route('all-practices.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
            <div class="table-responsive">
                <table id="example"
                    class="table table-striped data-table"
                    style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.practices.inputs.team_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.practices.inputs.location')
                            </th>
                            <th class="text-left">
                                @lang('crud.practices.inputs.date')
                            </th>
                            <th class="text-left">
                                @lang('crud.practices.inputs.start_time')
                            </th>
                            <th class="text-left">
                                @lang('crud.practices.inputs.end_time')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allPractices as $practices)
                        <tr>
                            <td>
                                {{ optional($practices->teams)->name ?? '-' }}
                            </td>
                            <td>{{ $practices->location ?? '-' }}</td>
                            <td>{{ $practices->date ?? '-' }}</td>
                            <td>{{ $practices->start_time ?? '-' }}</td>
                            <td>{{ $practices->end_time ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $practices)
                                    <a
                                        href="{{ route('all-practices.edit', $practices) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $practices)
                                    <a
                                        href="{{ route('all-practices.show', $practices) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-success mx-3"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $practices)
                                    <form
                                        action="{{ route('all-practices.destroy', $practices) }}"
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
                            <td colspan="6">{!! $allPractices->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
