@extends('dashboard.layout.app')
@section('title')
{{ $advertisement->title }} Ads
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Current {{ $advertisement->title }} Loading..</h2>
                </div>
                <iframe style="height: 70vh;" src="{{ $advertisement->url }}" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
@endsection
