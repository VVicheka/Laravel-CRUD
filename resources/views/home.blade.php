@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="mt-4 d-flex gap-2">
                        <a href="{{route('features.features')}}" class="btn btn-primary">
                            View Features
                        </a>

                        <a href="{{route('features.index')}}" class="btn btn-primary">
                            Manage Features
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
