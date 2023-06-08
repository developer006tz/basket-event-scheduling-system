@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-practices.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.practices.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.practices.inputs.teams_id')</h5>
                    <span>{{ optional($practices->teams)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.practices.inputs.location')</h5>
                    <span>{{ $practices->location ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.practices.inputs.date')</h5>
                    <span>{{ $practices->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.practices.inputs.start_time')</h5>
                    <span>{{ $practices->start_time ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.practices.inputs.end_time')</h5>
                    <span>{{ $practices->end_time ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-practices.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Practices::class)
                <a
                    href="{{ route('all-practices.create') }}"
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
