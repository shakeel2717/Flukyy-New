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
                    <h6 class="card-subtitle mb-2">Available USD Balance</h6>

                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="js-counter display-4 text-dark" data-value="24">{{ env('APP_CURRENCY_SYMBOL') }}:
                                {{ number_format(balanceUSD(), 2) }} {{ env('APP_CURRENCY') }}</span>
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
                    <h6 class="card-subtitle mb-2">Total USD Deposit</h6>

                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="js-counter display-4 text-dark" data-value="12">{{ env('APP_CURRENCY_SYMBOL') }}:
                                {{ number_format(
    userTransactions()->where('currency', 'USD')->where('type', 'Deposit')->sum('amount'),
    2,
) }}
                                {{ env('APP_CURRENCY') }}</span>
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
                    <h6 class="card-subtitle mb-2">Total Reward Point</h6>

                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="js-counter display-4 text-dark"
                                data-value="56">{{ number_format(balanceReward(), 2) }}</span>
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
                    <h6 class="card-subtitle mb-2">Total USD Withdraw</h6>

                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="js-counter display-4 text-dark" data-value="28">{{ env('APP_CURRENCY_SYMBOL') }}:
                                {{ number_format(
    userTransactions()->where('currency', 'USD')->where('type', 'Withdraw')->sum('amount'),
    2,
) }}
                                {{ env('APP_CURRENCY') }}</span>
                        </div>

                    </div>
                    <!-- End Row -->
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <!-- Card -->
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Available Token Balance</h6>

                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="js-counter display-4 text-dark"
                                data-value="24">{{ env('APP_CURRENCY_SYMBOL') }}:
                                {{ number_format(balanceToken(), 2) }} {{ env('APP_CURRENCY_TOKEN') }}</span>
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
                    <h6 class="card-subtitle mb-2">Total Token Earned</h6>

                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="js-counter display-4 text-dark"
                                data-value="12">{{ env('APP_CURRENCY_SYMBOL') }}:
                                {{ number_format(
    userTransactions()->where('currency', 'Token')->where('type', 'Deposit')->sum('amount'),
    2,
) }}
                                {{ env('APP_CURRENCY_TOKEN') }}</span>
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
                    <h6 class="card-subtitle mb-2">Shared with Friends Tokens</h6>

                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="js-counter display-4 text-dark" data-value="56">0.00</span>
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
                    <h6 class="card-subtitle mb-2">Total Token Convert</h6>

                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="js-counter display-4 text-dark"
                                data-value="28">{{ env('APP_CURRENCY_SYMBOL') }}:
                                {{ number_format(
    userTransactions()->where('currency', 'Token')->where('type', 'Withdraw')->sum('amount'),
    2,
) }}
                                {{ env('APP_CURRENCY_TOKEN') }}</span>
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
                    <p>Participate Price: {{ $Activecontest->price ?? 'No Contest Active' }} Reward</p>
                    <p>Current Contest ID: {{ $Activecontest->contest ?? 'No Contest Active' }}</p>
                </div>
                <form action="{{ route('contestParticepateReq') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" value="Particepate now">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- Card -->
            <div class="card h-100">
                <!-- Header -->
                <div class="card-header">
                    <h5 class="card-header-title">Reports overview</h5>

                    <!-- Unfold -->
                    <div class="hs-unfold">
                        <a class="js-hs-unfold-invoker btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                            href="javascript:;" data-hs-unfold-options="{
                                           &quot;target&quot;: &quot;#reportsOverviewDropdown1&quot;,
                                           &quot;type&quot;: &quot;css-animation&quot;
                                         }" data-hs-unfold-target="#reportsOverviewDropdown1" data-hs-unfold-invoker="">
                            <i class="tio-more-vertical"></i>
                        </a>

                        <div id="reportsOverviewDropdown1"
                            class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right mt-1 hs-unfold-hidden hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-reverse-y"
                            data-hs-target-height="243" data-hs-unfold-content=""
                            data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut"
                            style="animation-duration: 300ms;">
                            <span class="dropdown-header">Settings</span>

                            <a class="dropdown-item" href="#">
                                <i class="tio-share dropdown-item-icon"></i> Share reports
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="tio-download-to dropdown-item-icon"></i> Download
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="tio-alt dropdown-item-icon"></i> Connect other apps
                            </a>

                            <div class="dropdown-divider"></div>

                            <span class="dropdown-header">Feedback</span>

                            <a class="dropdown-item" href="#">
                                <i class="tio-chat-outlined dropdown-item-icon"></i> Report
                            </a>
                        </div>
                    </div>
                    <!-- End Unfold -->
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body">
                    <span class="h1 d-block mb-4">{{ count($Activecontest->participators) }} Participators</span>

                    <div class="progress h-25">
                        <div class="progress-bar" role="progressbar"
                            style="width: {{ count($Activecontest->participators) }}%;"
                            aria-valuenow="{{ count($Activecontest->participators) }}" aria-valuemin="0"
                            aria-valuemax="100">{{ count($Activecontest->participators) }}</div>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span>{{ count($Activecontest->participators) }}</span>
                        <span>{{ $Activecontest->participate }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    @if (count($Activecontest->participators) >= $Activecontest->participate)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Voting for Fluke</h2>
                        
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
