@extends('dashboard.layout.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Conver Token To USD</h6>
                    <hr>
                    <p>Current Token Balance: {{ env('APP_CURRENCY_SYMBOL') }}
                        {{ number_format(balanceToken(), 2) }} {{ env('APP_CURRENCY') }}</p>
                    <p>Current USD Balance: {{ env('APP_CURRENCY_SYMBOL') }}
                        {{ number_format(balanceUsd(), 2) }} {{ env('APP_CURRENCY') }}</p>
                </div>
                <form action="{{ route('tokenToUsdReq') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Token Amount to Convert</label>
                            <input type="text" name="amount" id="amount" class="form-control"
                                placeholder="Token Amount to Convert">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" value="Convert Now">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
