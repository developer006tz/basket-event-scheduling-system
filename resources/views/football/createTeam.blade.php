@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row d-flex justify-content-left">
            <div class="col-md-6">
                <h2>Add new Teams</h2>
            </div>
            <div class="col-md-6 text-right d-flex justify-content-end">
                    <a href="{{ url('football') }}" class="btn btn-primary">
                        <i class="icon ion-md-add"></i> Go to dashboard
                    </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
           <!-- handle form here  -->
        </div>
    </div>
</div>
@endsection