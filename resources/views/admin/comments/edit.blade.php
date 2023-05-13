@extends('layouts.admin')

@section('title','Админ панель - Редактирование данных ползователя')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admin_asset/admin.css')}}">
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Редактирование заявки №  $course->id }}@endslot
        @slot('parent') Басты бет @endslot
        @slot('comments') Комментариялар тізімі @endslot
        @slot('active') Комментария {{ $course->id }}@endslot
    @endcomponent

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <form method="post" action="{{ route('admin.courses.update', $course)}}" class="add_product_form" name="add_product_form"
                              enctype="multipart/form-data"
                        >
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">{{__('Аты')}}</label>
                                    <input type="text" value="{{ old('name') ?? ($course->name ?? "")}}"
                                           name="name" placeholder="Курстың атауы"
                                           class="form-control"
                                           required
                                    >
                                    @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{__('Сипаттамасы')}}</label>
                                    <textarea cols="12" rows="5" name="description"
                                              placeholder="Куртың сипаттамасы"
                                              required
                                              class="form-control ckeditor_description"
                                    >
                                     {{ old('description') ?? ($course->description ?? "")}}
                                    </textarea>
                                    @error('description')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{__('Автор')}}</label>
                                    <input type="text" class="form-control" name="author"
                                           placeholder="Автор"
                                           value="{{ old('author') ?? ($course->author ?? "")}}">
                                    @error('author')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="">{{__('Бағасы')}}</label>
                                    <input type="number" class="form-control" name="price" placeholder="30000"
                                           value="{{ old('price') ?? ($course->price ?? 0)}}">

                                    @error('price')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{__('Ескі бағасы')}}</label>
                                    <input type="number" class="form-control" name="old_price" placeholder="20000"
                                           value="{{ old('old_price') ?? ($course->old_price ?? "")}}">

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
                                                        {{$course->image ? 'Суретті өзгерту' : 'Суретті енгізу'}}
                                                    </label>
                                                </div>
                                                @error('image')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <img id="preview-image-before-upload" src="{{ asset($course->image
                                                    ? \App\Models\Course::IMAGE_PATH.$course->image
                                                    : 'images/image_not_found.gif') }}"
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
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            height: auto;
        }

        .file-input label {
            width: 158px;
            height: 40px;
            border-radius: 5px;
            border-color: #ddd;
            background: #eee;
            box-shadow: 0 3px 4px rgb(0 0 0 / 40%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            cursor: pointer;
            transition: transform 0.2s ease-out;
        }

        input:hover + label,
        input:focus + label {
            transform: scale(1.02);
        }
    </style>
@endsection
