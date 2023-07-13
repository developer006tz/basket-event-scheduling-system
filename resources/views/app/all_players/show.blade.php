@extends('layouts.app')

@section('content')
<div class="container content">
    <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
              <div class="col-12">
                <img src="{{ $players->user->image ? url(\Storage::url($players->user->image)) : asset('avatar.svg') }}" class="product-image img-fluid fluid " style="border-radius:20%;" alt="Product Image">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">{{$players->user->name }}</h3>
              <p>A Basktetball player with {{$players->age}} years old,</p>

              <hr>
              <h4>Team</h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center active">
                  <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked="">
                  @php 
                  $id = $players->team_id;
                    $team = \App\Models\Teams::find($id);
                  @endphp
                  {{$team->name}}
                  <br>
                  <i class="fas fa-circle fa-2x text-green"></i>
                </label>
                
              </div>

            
             {{-- table  --}}
             <table class="table">
                <thead>
                    <th>weight</th>
                    <th>height</th>
                    <th>Jersey Number</th>
                    <th>Age</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$players->weight}}</td>
                        <td>{{$players->height}}</td>
                        <td>{{$players->jersey_number}}</td>
                        <td>{{$players->age}} Yrs</td>

                    </tr>
                </tbody>

             </table>

            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
</div>

@endsection
