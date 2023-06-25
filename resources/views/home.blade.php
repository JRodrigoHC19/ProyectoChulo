@extends('layouts.app')

@section('content')
<?php use App\Models\Hotel ?>
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


                    <li class="nav-item">
                        <a class="nav-link" href="{{route('hotel')}}">Lo Mangliare</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('hotel')}}">La Molina</a>
                    </li>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
