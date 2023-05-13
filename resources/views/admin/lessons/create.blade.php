@extends('layouts.admin')

@section('title','Админ панель - Сабақ қосу')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admin_asset/admin.css')}}">
@endsection
@section('content')
    @component('admin.components.breadcrumb')
{{--        @slot('title') Сабақ қосу @endslot--}}
{{--        @slot('parent') Басты бет @endslot--}}
{{--        @slot('lessons') Cабақтар тізімі @endslot--}}
{{--        @slot('lesson_course_route'){{ route('admin.lessons.index',  [--}}
{{--                                                                        'course' => $module->course_id,--}}
{{--                                                                        'module' => $module->id--}}
{{--                                                                   ]) }}@endslot--}}
{{--        @slot('active') Сабақ қосу @endslot--}}

        @slot('title') Сабақ қосу @endslot
        @slot('parent') Басты бет @endslot
        @slot('courses') Курстар тізімі @endslot
        @slot('course_modules') {{ $module->course->name }} @endslot
        @slot('course_module_route'){{ route('admin.modules.index',  ['course' => $module->course_id]) }}@endslot

        @slot('module_lessons'){{ $module->name }}@endslot
        @slot('module_lesson_route'){{ route('admin.modules.index',  ['course' => $module->course_id]) }}@endslot
        @slot('active') Сабақ қосу @endslot
    @endcomponent

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $module->name }} модульіне сабақ қосу </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.lessons.store', [
                                                                        'course' => $module->course_id,
                                                                        'module' => $module->id
                                                                   ])}}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Сабақ тақырыбы <i class="fa red">*</i></label>
                                            <input type="text" name="name"
                                                   class="form-control" id="name"
                                                   placeholder="Сабақ тақырыбы" value="{{old('name') ?? ''}}">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="task">Сабақ сипаттамасы</label>
                                            <textarea
                                                name="description"
                                                class="form-control ckeditor_description"
                                                id="ckeditor_description"
                                                cols="30" rows="10"
                                                placeholder="Сабақ сипаттамасы">{{ old('description') ?? '' }}</textarea>
                                            @error('description')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="task">Сабақ тапсырмасы</label>
                                            <textarea
                                                name="task"
                                                class="form-control ckeditor_description"
                                                id="ckeditor_task"
                                                cols="30" rows="10"
                                                placeholder="">{{ old('task') ?? '' }}</textarea>
                                            @error('task')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="file_1">Материал файл - 1 (Файл):</label>
                                            <br>
                                            <input type="file" name="file_1"
                                                   id="file_1">
                                            @error('file_1')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="file_2">Материал файл - 2 (Файл):</label>
                                            <br>
                                            <input type="file" name="file_2"
                                                   id="file_2">
                                            @error('file_2')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="file_3">Материал файл - 3 (Файл):</label>
                                            <br>
                                            <input type="file" name="file_3"
                                                   id="file_3">

                                            @error('file_3')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_test_enabled"
                                                       class="custom-control-input" id="customSwitch1"
                                                       @if(in_array(old('is_test_enabled'), \App\Services\LessonService::$checkboxTrueValues)) checked @endif
                                                >
                                                <label class="custom-control-label" for="customSwitch1">Tест Қосу</label>
                                            </div>
                                        </div>
{{--                                        <div class="form-group">--}}
{{--                                            <label for="">Тест уақыты (мин) </label>--}}
{{--                                            <input type="number" name="test_duration" class="form-control"--}}
{{--                                                   placeholder="30" value="{{ old('test_duration')  }}">--}}
{{--                                            @error('test_duration')--}}
{{--                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <label for="">Тесттен өту балы (%) </label>
                                            <input type="number" name="passing_test_percent" class="form-control"
                                                   placeholder="75%" value="{{ old('passing_test_percent') ?? 50 }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="video_1">Видео 1 (iframe форматта) <i class="fa red">*</i></label>
                                            <input type="text" name="video_1"
                                                   class="form-control mt-2" id="video_1"
                                                   placeholder="" value="{{old('video_1') ?? '' }}">
                                            @error('video_1')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="video_2">Видео 2 (iframe форматта)</label>
                                            <input type="text" name="video_2"
                                                   class="form-control mt-2" id="video_2"
                                                   placeholder="" value="{{old('video_2') ?? ''}}">
                                            @error('video_2')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="video_3">Видео 3 (iframe форматта)</label>

                                            <input type="text" name="video_3"
                                                   class="form-control mt-2" id="video_3"
                                                   placeholder="" value="{{ old('video_3') ?? '' }}">
                                            @error('video_3')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Сақтау &nbsp;
                                </button>
                                <a class="btn btn-danger"
                                   href="{{ redirect()->getUrlGenerator()->previous() }}">Назад</a>
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
