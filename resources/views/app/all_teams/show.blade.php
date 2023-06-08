@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-teams.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.teams.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.teams.inputs.name')</h5>
                    <span>{{ $teams->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.teams.inputs.coaches_id')</h5>
                    <span>{{ optional($teams->coaches)->id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.teams.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $teams->image ? \Storage::url($teams->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.teams.inputs.location')</h5>
                    <span>{{ $teams->location ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('all-teams.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Teams::class)
                <a href="{{ route('all-teams.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
