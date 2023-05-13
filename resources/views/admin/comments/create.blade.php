@extends('layouts.admin')

@section('title','Админ панель - Редактирование данных ползователя')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admin_asset/admin.css')}}">
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Создать курс №  $course->id }}@endslot
        @slot('parent') Басты бет @endslot
        @slot('order') Список заявок @endslot
        @slot('active') Курс қосу@endslot
    @endcomponent

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <form method="post" action="{{ route('admin.courses.store')}}" class="add_product_form" name="add_product_form"
                              enctype="multipart/form-data"
                        >
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">{{__('Аты')}}</label>
                                    <input type="text" value="{{old('name') ?? ''}}"
                                           name="name" placeholder="Курстың атауы"
                                           required
                                    >
                                    @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('Сипаттамасы')}}</label>
                                    <textarea cols="12" rows="5" name="description" required
                                              class="form-control ckeditor_description"
                                              placeholder="Куртың сипаттамасы">
                                        {{ old('description') ?? '' }}
                                    </textarea>
                                    @error('description')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{__('Автор')}}</label>
                                    <input type="text" class="form-control"
                                           name="author" placeholder="Автор"
                                           value="{{old('author') ?? ''}}" required>
                                    @error('author')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="">{{__('Бағасы')}}</label>
                                    <input type="number" class="form-control" name="price" placeholder="30000"
                                           value="{{old('price') ?? 0}}" required>
                                    @error('price')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{__('Ескі бағасы')}}</label>
                                    <input type="number" class="form-control" name="old_price" placeholder="20000"
                                           value="{{old('old_price') ?? 0}}">
                                    @error('old_price')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('Сурет')}}:</label>
                                    <div class="image ml-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="file-input" style="margin-right: 10px">
                                                    <input type="file" hidden name="image" class="file" id="image">
                                                    <label for="image">
                                                       Суретті енгізу
                                                    </label>
                                                </div>
                                                @error('image')
                                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <img id="preview-image-before-upload" src="{{ asset('images/image_not_found.gif') }}"
                                                 alt="preview image" style="height: auto;width: 30%;">
                                        </div>
                                    </div>
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
    <style>
        .file {
            opacity: 0;
            width: 0.1px;
            height: 0.1px;
        }
        .files {
            opacity: 0;
            width: 0.1px;
            height: 0.1px;
        }

        .file-input label {
            width: 158px;
            height: 40px;
            border-radius: 5px;
            border-color: #ddd;
        //background: #d0d0d0;
            background: #eee;
            box-shadow: 0 3px 4px rgb(0 0 0 / 40%);
            display: flex;
            align-items: center;
            justify-content: center;
        //color: #fff;
            color: #555;
            cursor: pointer;
            transition: transform 0.2s ease-out;
        }

        input:hover + label,
        input:focus + label {
            transform: scale(1.02);
        }
        .file-input-block {
            display: flex;
            align-items: center;
        }


    </style>
@endsection
