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
                            <span class="js-counter display-4 text-dark" data-value="24">{{ $totalUsers->count() }}</span>
                            <span class="text-body font-size-sm ml-1">from {{ $totalUsers->count() }}</span>
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
                            <span class="js-counter display-4 text-dark"
                                data-value="12">{{ $totalUsers->where('status', 'Active')->count() }}</span>
                            <span class="text-body font-size-sm ml-1">from {{ $totalUsers->count() }}</span>
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
                            <span class="js-counter display-4 text-dark"
                                data-value="56">{{ $totalUsers->where('created_at', '>=', \Carbon\Carbon::now())->count() }}</span>
                            <span class="text-body font-size-sm ml-1">from {{ $totalUsers->count() }}</span>
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
                            <span class="js-counter display-4 text-dark"
                                data-value="28">{{ $totalUsers->where('status', 'Suspended')->count() }}</span>
                            <span class="text-body font-size-sm ml-1">from {{ $totalUsers->count() }}</span>
                        </div>

                    </div>
                    <!-- End Row -->
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-6">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Particepate In Fluke</h6>
                    <hr>
                    <p>Participate Price: {{ $adminQuery->contest }} Token</p>
                    <p>Current Contest ID: SXCSADFSDF</p>
                </div>
                <form action="{{ route('contest.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Participate</label>
                            <input type="text" name="participate" id="participate" class="form-control"
                                placeholder="TotalParticipate Allowed">
                        </div>
                        <div class="form-group">
                            <label for="">Contest Price</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Token Price"
                                value="{{ $adminQuery->contest }}">
                        </div>
                        {{-- <div class="form-group">
                            <label for="address">Shipping Address</label> <span><a
                                    href="{{ route('address.index') }}">Manage Address</a></span>
                            <select name="address" id="address" class="form-control">
                                @foreach ($addresses as $address)
                                    <option value="{{ $address->id }}">{{ $address->address }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" value="Create New Contest">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Particepate In Fluke</h6>
                    <hr>
                    <p>Coupon Buy USD Amount: {{ $adminQuery->coupon }} USD</p>
                    <p>Update Price for Coupon Buy LIMIT, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste
                        cumque ratione officia molestiae accusamus atque laboriosam fugiat repellendus obcaecati. Blanditiis
                        minus pariatur est quibusdam cupiditate, eligendi maiores rem repudiandae porro</p>
                </div>
                <form action="{{ route('coupon.admin.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Price in USD</label>
                            <input type="text" name="coupon" id="coupon" class="form-control"
                                value="{{ $adminQuery->coupon }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" value="Update Coupon BUY Price">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
