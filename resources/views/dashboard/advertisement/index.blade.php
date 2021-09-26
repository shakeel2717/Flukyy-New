@extends('dashboard.layout.app')
@section('title')
    Advertisement
@endsection
@section('content')
    <div class="row">
        @foreach ($advertisements as $advertisement)
            <div class="col-sm-12 col-md-6 col-lg-3">
                <a href="{{ route('advertisement.show',['advertisement' => $advertisement->id]) }}">
                    <div class="card mb-4 bg-success">
                        <div class="card-body">
                            <h2 class="card-title text-white">{{ $advertisement->title }}</h2>
                            <p class="text-white">Click to Watch this Ads</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
