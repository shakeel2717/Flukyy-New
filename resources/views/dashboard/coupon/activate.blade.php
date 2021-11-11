@extends('dashboard.layout.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Paste Your 40 character code here to get instantly Token</h6>
                    <hr>
                    <p>Available Token {{ env('APP_CURRENCY_SYMBOL') }}
                        {{ number_format(balanceToken(), 2) }} {{ env('APP_CURRENCY') }}</p>
                </div>
                <form action="{{ route('couponActive.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="amount">Enter Your Coupon to Activate</label>
                            <input type="text" name="coupon" id="coupon" class="form-control" placeholder="Paste Coupon to Activate">
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" value="Activate This Code">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
