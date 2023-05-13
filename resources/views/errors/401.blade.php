@extends('errors::minimal')

@section('title', __('message.Unauthorized'))
@section('code', '401')
@section('message', __('message.Unauthorized'))


@extends('layouts.app')

@section('title', __('message.Unauthorized'))
@section('content')
    <div class="container mt-5 pt-5">
        <div class="alert alert-danger text-center">
            <h2 class="display-3">401</h2>
            <p class="display-5">{{__('message.Unauthorized')}}</p>
        </div>
    </div>
@endsection


