@extends('layouts.app')

@section('content')

<div class="container-fluid">
        <div class="row">
          <div class="col-md-12 float-right">
            <h4>Welcome {{Auth::user()->name}}
                                @forelse (Auth::user()->roles as $role)
                    <b class="btn btn-sm disabled btn-success">{{ $role->name }}</b>
                @empty - @endforelse</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white h-100">
              <div class="card-body py-5">All Users {{ count($users) ?? '-' }}</div>
              <a href="{{route('users.index')}}" class="card-footer d-flex link">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark h-100">
              <div class="card-body py-5">Players {{ $players->count()?? '-' }}<sup style="font-size: 20px"></sup></div>
              <a href="{{route('all-players.index')}}" class="card-footer d-flex link">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
                </a>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
              <div class="card-body py-5">Coaches {{ $coaches->count()?? '-' }}</div>
              <a href="{{route('all-coaches.index')}}}" class="card-footer d-flex link">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100">
              <div class="card-body py-5">Teams {{ count($teams) ?? '-' }}</div>
              <a href="{{route('all-teams.index')}}" class="card-footer d-flex link">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Area Chart Example
              </div>
              <div class="card-body">
                <canvas class="chart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Area Chart Example
              </div>
              <div class="card-body">
                <canvas class="chart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Table
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr>
                        <td>Donna Snider</td>
                        <td>Customer Support</td>
                        <td>New York</td>
                        <td>27</td>
                        <td>2011/01/25</td>
                        <td>$112,000</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection
