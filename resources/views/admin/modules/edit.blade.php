@extends('layouts.admin')

@section('title','Админ панель - Модульді өзгерту')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admin_asset/admin.css')}}">
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Модульді өзгерту № {{ $module->id }}@endslot
        @slot('parent') Басты бет @endslot
        @slot('courses') Курстар тізімі @endslot
        @slot('course_modules') {{ $module->course->name }} @endslot
        @slot('course_module_route') {{ route('admin.modules.index', ['course' => $module->course_id]) }} @endslot
        @slot('active')  {{ $module->id }}@endslot
    @endcomponent


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <form method="post" action="{{ route('admin.modules.update', ['course' => $module->course_id, 'module' => $module->id])}}" class="add_product_form" name="add_product_form"
                        >
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">{{__('Аты')}}</label>
                                    <input type="text" value="{{ old('name') ?? ($module->name ?? "")}}"
                                           name="name" placeholder="Модульдің атауы"
                                           class="form-control"
                                           required
                                    >
                                    @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a class="btn btn-danger" href="{{ redirect()->getUrlGenerator()->previous() }}">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
