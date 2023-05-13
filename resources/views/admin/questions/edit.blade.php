@extends('layouts.admin')

@section('title','Админ панель - Сұрақты өзгерту')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admin_asset/admin.css')}}">
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Сұрақты өзгерту № {{ $question->id }}@endslot
        @slot('parent') Басты бет @endslot
        @slot('questions') Сұрақты тізімі @endslot
        @slot('active') Сұрақты өзгерту №  {{ $question->id }}@endslot
    @endcomponent

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <form method="post" action="{{ route('admin.questions.update', $question)}}" class="add_product_form" name="add_product_form"
                        >
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">{{__('Сұрақ')}}</label>
                                    <input type="text" value="{{ old('text') ?? ($question->text ?? "")}}"
                                           name="text" placeholder="Курстың атауы"
                                           class="form-control"
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
                                        id="ckeditor_description"
                                        cols="30" rows="10"
                                        placeholder="Жауап">{{ old('answer') ??  ($question->answer ?? "")}}</textarea>
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
