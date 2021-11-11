@extends('dashboard.layout.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Buy 75$ worth of copon to open your store with flukyy</h6>
                    <hr>
                    <p>Each Redemption Token Price = 0.015</p>
                    <p>Available USD {{ env('APP_CURRENCY_SYMBOL') }}
                        {{ number_format(balanceUSD(), 2) }} {{ env('APP_CURRENCY') }}</p>
                </div>
                <form action="{{ route('coupon.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="amount">Select Redemption Value</label>
                            <select name="redemption" id="redemption" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="5">5</option>
                                <option value="8">8</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="40">40</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" value="Buy Coupon Codes">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
