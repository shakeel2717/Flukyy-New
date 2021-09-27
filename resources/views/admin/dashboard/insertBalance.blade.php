@extends('admin.dashboard.layout.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-8 mx-auto">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Add Balance</h6>
                    <hr>
                    <form action="{{route('insertBalanceReq')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Email of User</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="User's Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Currency Type</label>
                                    <select name="currency" id="currency" class="form-control">
                                        <option value="USD">USD</option>
                                        <option value="Token">Token</option>
                                        <option value="Reward">Reward</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit"class="btn btn-block btn-primary" value="Add Balance">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
