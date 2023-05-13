@extends('layouts.admin')

@section('title','Админ панель - Сабақты өзгерту')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admin_asset/admin.css')}}">
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Сабақты өзгерту - {{$lesson->name}}@endslot
        @slot('parent') Басты бет @endslot
        @slot('lessons') Cабақтар тізімі @endslot
        @slot('lesson_course_route'){{ route('admin.lessons.index',   [
                                                    'course' => $module->course_id,
                                                     'module' => $module->id,
                                                     ]) }}@endslot

        @slot('active') {{$lesson->name}}@endslot
    @endcomponent

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Сабақты өзгерту {{ $lesson->name? " - $lesson->name" : '' }}</h5>
                        </div>
                        <form action="{{ route('admin.lessons.update',  [
                                                    'course' => $module->course_id,
                                                     'module' => $module->id,
                                                     'lesson' => $lesson->id
                                                     ])}}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Сабақ тақырыбы <i class="fa red">*</i></label>
                                            <input type="text" name="name"
                                                   class="form-control" id="name"
                                                   placeholder="Сабақ тақырыбы" value="{{$lesson->name}}">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Сипаттамасы <i class="fa red">*</i></label>
                                            <textarea
                                                name="description"
                                                class="form-control ckeditor_description"
                                                id="ckeditor_description"
                                                cols="30" rows="10"
                                                placeholder="">{{$lesson->description}}</textarea>
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
                                                placeholder="">{{$lesson->task}}</textarea>
                                            @error('task')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="file_1">Материал файл - 1 (Файл):</label>
                                            <br>
                                            @if($lesson->file_1)
                                                <b class="text-success">
                                                    {{$lesson->file_1}}</b>
                                                <a href="{{route('downloadFile', ['path' => \App\Models\Lesson::FILES_PATH . $module->course_id
                                                                                        ."/$lesson->file_1"])}}"
                                                   target="_blank"
                                                   title="Жою"
                                                   class="btn btn-sm ml-2">
                                                    <i class=" fas fa-download"></i> &nbsp;
                                                </a>
                                                <a href="{{route('admin.lessons.delete_file',[
                                                                                                'course' => $module->course_id,
                                                                                                'module' => $module->id,
                                                                                                'lesson' => $lesson->id,
                                                                                                'number'=> 1
                                                                                                ])}}"
                                                    title="Жою"
                                                    class="btn btn-sm ml-2">
                                                    <i class="nav-icon fas fa-trash"></i> &nbsp;
                                                </a>
                                            @else
                                                <input type="file" name="file_1"
                                                       id="file_1">
                                            @endif
                                            @error('file_1')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="file_2">Материал файл - 2 (Файл):</label>
                                            <br>
                                            @if($lesson->file_2)
                                                <b class="text-success">
                                                    {{$lesson->file_2}}</b>
                                                <a href="{{route('downloadFile', ['path' => \App\Models\Lesson::FILES_PATH . $module->course_id ."/$lesson->file_2"])}}"
                                                   target="_blank"
                                                   title="Жою"
                                                   class="btn btn-sm ml-2">
                                                    <i class=" fas fa-download"></i> &nbsp;
                                                </a>
                                                <a href="{{route('admin.lessons.delete_file',[
                                                                                                'course' => $module->course_id,
                                                                                                'module' => $module->id,
                                                                                                'lesson' => $lesson->id,
                                                                                                'number'=> 2])}}"
                                                   title="Жою"
                                                   class="btn btn-sm ml-2">
                                                    <i class="nav-icon fas fa-trash"></i> &nbsp;
                                                </a>

                                            @else
                                                <input type="file" name="file_2"
                                                       id="file_2">
                                            @endif
                                            @error('file_2')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="file_3">Материал файл - 3 (Файл):</label>
                                            <br>
                                            @if($lesson->file_3)
                                                <b class="text-success">{{$lesson->file_3}}</b>
                                                <a href="{{route('downloadFile', ['path' => \App\Models\Lesson::FILES_PATH . $module->course_id ."/$lesson->file_3"])}}"
                                                   target="_blank"
                                                   title="Жою"
                                                   class="btn btn-sm ml-2">
                                                    <i class=" fas fa-download"></i> &nbsp;
                                                </a>

                                                <a href="{{route('admin.lessons.delete_file',[
                                                                                                'course' => $module->course_id,
                                                                                                'module' => $module->id,
                                                                                                'lesson' => $lesson->id,
                                                                                                'number'=> 3])}}"
                                                   title="Жою"
                                                   class="btn btn-sm ml-2">
                                                    <i class="nav-icon fas fa-trash"></i> &nbsp;
                                                </a>
                                            @else
                                                <input type="file" name="file_3" id="file_3">
                                            @endif
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
                                                       @if($lesson->is_test_enabled || in_array(old('is_test_enabled'), \App\Services\LessonService::$checkboxTrueValues)) checked @endif
                                                >
                                                <label class="custom-control-label" for="customSwitch1">Tест Қосу</label>
                                            </div>
                                        </div>
{{--                                        <div class="form-group">--}}
{{--                                            <label for="">Тест уақыты (мин) </label>--}}
{{--                                            <input type="number" name="test_duration" class="form-control"--}}
{{--                                                   placeholder="30" value="{{ old('test_duration') ?? $lesson->test_duration }}">--}}
{{--                                            @error('test_duration')--}}
{{--                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <label for="">Тесттен өту балы (%) </label>
                                            <input type="number" name="passing_test_percent" class="form-control"
                                                   placeholder="75%" value="{{ old('passing_test_percent') ?? $lesson->passing_test_percent }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="video_1">Видео 1 (iframe форматта) <i class="fa red">*</i></label>

                                            @if($lesson->video_1)
                                                <div class="plyr__video-embed player_lesson ">
                                                    {!! $lesson->video_1 !!}
                                                    {{--                                                    <iframe width="871" height="490"--}}
                                                    {{--                                                            --}}{{--                                                            src="https://vimeo.com/533296237/ffb9d4c482"--}}
                                                    {{--                                                            src="{{$lesson->video_1}}"--}}
                                                    {{--                                                            --}}{{--                                                            src="https://www.youtube.com/embed/FDch-tr_P5A"--}}
                                                    {{--                                                            title="YouTube video player" frameborder="0"--}}
                                                    {{--                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
                                                    {{--                                                            allowfullscreen></iframe>--}}
                                                    {{--                                                    {!! $lesson->video_1 !!}--}}
                                                </div>
                                            @endif

                                            <input type="text" name="video_1"
                                                   class="form-control mt-2" id="video_1"
                                                   placeholder="" value="{{$lesson->video_1}}">
                                            @error('video_1')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="video_2">Видео 2 (iframe форматта)</label>

                                            @if($lesson->video_2)
                                                <div class="plyr__video-embed player_lesson ">
                                                    {!! $lesson->video_2 !!}
                                                    {{--                                                    <iframe width="871" height="490"--}}
                                                    {{--                                                            src="{{$lesson->video_2}}"--}}
                                                    {{--                                                            title="YouTube video player" frameborder="0"--}}
                                                    {{--                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
                                                    {{--                                                            allowfullscreen></iframe>--}}
                                                </div>
                                            @endif

                                            <input type="text" name="video_2"
                                                   class="form-control mt-2" id="video_2"
                                                   placeholder="" value="{{$lesson->video_2}}">
                                            @error('video_2')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="video_3">Видео 3 (iframe форматта)</label>

                                            @if($lesson->video_3)
                                                <div class="plyr__video-embed player_lesson ">
                                                    {!! $lesson->video_3 !!}
                                                    {{--                                                    <iframe width="871" height="490"--}}
                                                    {{--                                                            src="{{$lesson->video_3}}"--}}
                                                    {{--                                                            title="YouTube video player" frameborder="0"--}}
                                                    {{--                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
                                                    {{--                                                            allowfullscreen></iframe>--}}
                                                </div>
                                            @endif

                                            <input type="text" name="video_3"
                                                   class="form-control mt-2" id="video_3"
                                                   placeholder="" value="{{$lesson->video_3}}">
                                            @error('video_3')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="nav-icon fas fa-save"></i> &nbsp;
                                    Сақтау &nbsp;
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
