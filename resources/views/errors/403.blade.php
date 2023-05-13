@extends('layouts.app')

@section('title', __('message.Forbidden'))
@section('content')
    <div class="container mt-5 pt-5">
        <div class="alert alert-danger text-center">
            <h2 class="display-3">403</h2>
            <p class="display-5">{{__('message.Forbidden')}}</p>
        </div>
    </div>
@endsection

