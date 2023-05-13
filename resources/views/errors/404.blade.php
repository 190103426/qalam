@extends('layouts.app')

@section('title', __('message.Not Found'))
@section('content')
    <div class="container mt-5 pt-5">
        <div class="alert alert-danger text-center">
            <h2 class="display-3">404</h2>
            <p class="display-5"> {{__('message.Not Found')}}.</p>
        </div>
    </div>
@endsection
