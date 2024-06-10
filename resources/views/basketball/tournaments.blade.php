@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Tournament</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                    <a href="{{ url($url.'/Tournaments/Create') }}" class="btn btn-primary">
                        <i class="icon ion-md-add"></i> Create New Tournament
                    </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Year</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>First Winner Award</th>
                            <th>Second Winner Award</th>
                            <th>Third Winner Award</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tournaments as $tournament)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $tournament->name }}</td>
                        <td>{{ $tournament->year }}</td>
                        <td>{{ $tournament->start_date }}</td>
                        <td>{{ $tournament->end_date }}</td>
                        <td>{{ $tournament->first_winner_award }}</td>
                        <td>{{ $tournament->second_winner_award }}</td>
                        <td>{{ $tournament->third_winner_award }}</td>
                        <td class="text-center">
                            <a href="{{url("basketball/Tournaments/Update?tournament_id=$tournament->id")}}" class="btn btn-primary">edit</a>
                            <a href="{{url("basketball/Tournaments/Delete?tournament_id=$tournament->id")}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Tournament?')">delete</a>                        </td>
                        </tr>
                        @empty 
                        <tr>
                            <td colspan="9" class="text-center">
                                <img src="{{asset('/empty.png')}}" alt="empty">
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