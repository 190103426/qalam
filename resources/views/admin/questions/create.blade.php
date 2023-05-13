@extends('layouts.admin')

@section('title','Админ панель - Сұрақ қосу')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admin_asset/admin.css')}}">
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Сұрақ қосу @endslot
        @slot('parent') Басты бет @endslot
        @slot('questions') Сұрақтар тізімі  @endslot
        @slot('active') Сұрақ қосу@endslot
    @endcomponent

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <form method="post" action="{{ route('admin.questions.store')}}" class="add_product_form" name="add_product_form"
                        >
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="text">{{__('Сұрақ')}}</label>
                                    <input type="text" value="{{ old('text') ?? ""}}"
                                           name="text" placeholder="Курстың атауы"
                                           class="form-control"
                                           id="text"
                                           required
                                    >
                                    @error('text')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="answer">Жауап <i class="fa red">*</i></label>
                                    <textarea
                                        name="answer"
                                        class="form-control ckeditor_description"
                                        id="answer"
                                        cols="30" rows="10"
                                        placeholder="Жауап">{{ old('answer') ?? '' }}</textarea>
                                    @error('answer')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сақтау</button>
                                <a class="btn btn-danger" href="{{ redirect()->getUrlGenerator()->previous() }}">Артқа</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
