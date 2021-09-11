@extends('admin.dashboard.layout.app')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="row gx-2 gx-lg-3">
  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <div class="card h-100">
      <div class="card-body">
        <h6 class="card-subtitle mb-2">Total users</h6>

        <div class="row align-items-center gx-2">
          <div class="col">
            <span class="js-counter display-4 text-dark" data-value="24">{{$totalUsers->count()}}</span>
            <span class="text-body font-size-sm ml-1">from {{$totalUsers->count()}}</span>
          </div>

        </div>
        <!-- End Row -->
      </div>
    </div>
    <!-- End Card -->
  </div>

  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <div class="card h-100">
      <div class="card-body">
        <h6 class="card-subtitle mb-2">Active members</h6>

        <div class="row align-items-center gx-2">
          <div class="col">
            <span class="js-counter display-4 text-dark" data-value="12">{{$totalUsers->where('status','Active')->count()}}</span>
            <span class="text-body font-size-sm ml-1">from {{$totalUsers->count()}}</span>
          </div>
        </div>
        <!-- End Row -->
      </div>
    </div>
    <!-- End Card -->
  </div>

  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <div class="card h-100">
      <div class="card-body">
        <h6 class="card-subtitle mb-2">New User</h6>

        <div class="row align-items-center gx-2">
          <div class="col">
            <span class="js-counter display-4 text-dark" data-value="56">{{$totalUsers->where('created_at', '>=', \Carbon\Carbon::now())->count()}}</span>
            <span class="text-body font-size-sm ml-1">from {{$totalUsers->count()}}</span>
          </div>
        </div>
        <!-- End Row -->
      </div>
    </div>
    <!-- End Card -->
  </div>

  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <div class="card h-100">
      <div class="card-body">
        <h6 class="card-subtitle mb-2">Suspended members</h6>

        <div class="row align-items-center gx-2">
          <div class="col">
            <span class="js-counter display-4 text-dark" data-value="28">{{$totalUsers->where('status','Suspended')->count()}}</span>
            <span class="text-body font-size-sm ml-1">from {{$totalUsers->count()}}</span>
          </div>
          
        </div>
        <!-- End Row -->
      </div>
    </div>
    <!-- End Card -->
  </div>
</div>
@endsection