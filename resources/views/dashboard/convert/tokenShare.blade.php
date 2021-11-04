@extends('dashboard.layout.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Share Token with Friends</h6>
                    <hr>
                    <p>Current Token Balance: {{ env('APP_CURRENCY_SYMBOL') }}
                        {{ number_format(balanceToken(), 2) }} {{ env('APP_CURRENCY') }}</p>
                </div>
                <form action="{{ route('tokenShareReq') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="amount">Token Amount to Share</label>
                            <input type="text" name="amount" id="amount" class="form-control"
                                placeholder="Token Amount to Convert">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="username">Friends Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Token Amount to Convert">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" value="Share Now">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
