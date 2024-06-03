@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Players</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                <a href="{{ url($url.'/Players/Create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Create New Player
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Age</th>
                            <th>Team</th>
                            <th>Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($players as $player)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $player->name }}</td>
                            <td>{{ $player->email }}</td>
                            <td>{{ $player->phone }}</td>
                            <td>{{ $player->age }}</td>
                            <td>{{ $player->team->name ?? 'N/A' }}</td>
                            <td>{{ $player->course->name ?? 'N/A' }}</td>
                            <td class="text-center">
                                <a href="{{ url("$url/Players/Update?player_id=$player->id") }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url("$url/Players/Delete?player_id=$player->id") }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Player?')">Delete</a>
                            </td>
                        </tr>
                        @empty 
                        <tr>
                            <td colspan="8" class="text-center">
                                <img src="{{ asset('/empty.png') }}" alt="empty">
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
