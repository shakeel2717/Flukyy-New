@extends('dashboard.layout.app')
@section('title')
Dashboard
@endsection
@section('content')
<div class="row gx-2 gx-lg-3">
  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
      <!-- Card -->
      <div class="card h-100">
          <div class="card-body">
              <h6 class="card-subtitle mb-2">Available Balance</h6>

              <div class="row align-items-center gx-2">
                  <div class="col">
                      <span class="js-counter display-4 text-dark" data-value="24">{{ env('APP_CURRENCY_SYMBOL') }}:
                          {{ number_format(0.00, 2) }} {{ env('APP_CURRENCY') }}</span>
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
              <h6 class="card-subtitle mb-2">Total Deposit</h6>

              <div class="row align-items-center gx-2">
                  <div class="col">
                      <span class="js-counter display-4 text-dark" data-value="12">{{ env('APP_CURRENCY_SYMBOL') }}:
                          {{ number_format(0.00, 2) }} {{ env('APP_CURRENCY') }}</span>
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
              <h6 class="card-subtitle mb-2">Pending Withdraw</h6>

              <div class="row align-items-center gx-2">
                  <div class="col">
                      <span class="js-counter display-4 text-dark" data-value="56">{{ env('APP_CURRENCY_SYMBOL') }}:
                          {{ number_format(0.00, 2) }} {{ env('APP_CURRENCY') }}</span>
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
              <h6 class="card-subtitle mb-2">Total Withdraw</h6>

              <div class="row align-items-center gx-2">
                  <div class="col">
                      <span class="js-counter display-4 text-dark" data-value="28">{{ env('APP_CURRENCY_SYMBOL') }}:
                          {{ number_format(0.00, 2) }} {{ env('APP_CURRENCY') }}</span>
                  </div>

              </div>
              <!-- End Row -->
          </div>
      </div>
      <!-- End Card -->
  </div>
</div>
@endsection