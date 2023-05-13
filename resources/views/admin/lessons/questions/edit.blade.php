@extends('layouts.admin')

@section('title','Админ панель - Сабақты өзгерту')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admin_asset/admin.css')}}">
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Сұрақты өзгерту - {{$question->id}}@endslot
        @slot('parent') Басты бет @endslot
        @slot('courses') Курстар тізімі @endslot
        @slot('course_modules') {{ $lesson->module->course->name }} @endslot
        @slot('course_module_route'){{ route('admin.modules.index',  ['course' => $lesson->module->course_id]) }}@endslot
        @slot('module_lessons') {{ $lesson->module->name }} @endslot
        @slot('module_lesson_route'){{ route('admin.lessons.index',  ['course' => $lesson->module->course_id, 'module' => $lesson->module_id]) }}@endslot
        @slot('lesson_questions') {{ $lesson->name }} @endslot
        @slot('lesson_question_route') {{ route('admin.lessons.questions.index',
                        [
                            'course' => $lesson->module->course_id,
                            'module' => $lesson->module_id,
                            'lesson' => $lesson->id
                        ]) }} @endslot
        @slot('active') {{$question->id}}@endslot
    @endcomponent

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cұрақты өзгерту - {{ ($question->id) }}</h3>
                        </div>
                        <form action="{{ route('admin.lessons.questions.update', [
                            'course' => $lesson->module->course_id,
                            'module' => $lesson->module_id,
                            'lesson' => $lesson->id,
                            'question' => $question->id
                        ])}}"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Сұрақ <i class="fa red">*</i></label>
                                            <textarea
                                                name="text"
                                                class="form-control ckeditor_description"
                                                id="ckeditor_description"
                                                cols="30" rows="10"
                                                placeholder="">{{$question->text}}</textarea>
                                            @error('text')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="task">Жауап A <i class="fa red">*</i></label>
                                            <textarea
                                                name="answer_1"
                                                class="form-control ckeditor_description"
                                                id="ckeditor_description"
                                                cols="30" rows="10"
                                                placeholder="">{{$question->answer_1}}</textarea>
                                            @error('answer_1')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="task">Жауап B <i class="fa red">*</i></label>
                                            <textarea
                                                name="answer_2"
                                                class="form-control ckeditor_description"
                                                id="ckeditor_description"
                                                cols="30" rows="10"
                                                placeholder="">{{$question->answer_2}}</textarea>
                                            @error('answer_2')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="answer_3">Жауап C <i class="fa red">*</i></label>
                                            <textarea
                                                name="answer_3"
                                                class="form-control ckeditor_description"
                                                id="ckeditor_description"
                                                cols="30" rows="10"
                                                placeholder="">{{$question->answer_3}}</textarea>
                                            @error('answer_3')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="answer_4">Жауап D <i class="fa red">*</i></label>
                                            <textarea
                                                name="answer_4"
                                                style="height: 50px;max-height: 50px;"
                                                class="form-control ckeditor_description"
                                                id="ckeditor_description"
                                                cols="3" rows="3"
                                                placeholder="">{{$question->answer_4}}</textarea>
                                            @error('answer_4')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="answer_5">Жауап E <i class="fa red">*</i></label>
                                            <textarea
                                                name="answer_5"
                                                class="form-control ckeditor_description"
                                                id="ckeditor_description"
                                                cols="30" rows="10"
                                                placeholder="">{{$question->answer_5}}</textarea>
                                            @error('answer_5')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div> -->
                                        <div class="form-group">
                                            <label for="current_answer_number">Дұрыс жауапты таңдаңыз <i class="fa red">*</i></label>
                                            <select name="current_answer_number" id="" class="form-control">
                                                <option value="" disabled selected>Дұрыс жауапты таңдаңыз</option>
                                                <option value="1"  @if ($question->current_answer_number == 1) selected @endif>Жауап A</option>
                                                <option value="2"  @if ($question->current_answer_number == 2) selected @endif>Жауап B</option>
                                                <option value="3"  @if ($question->current_answer_number == 3) selected @endif>Жауап C</option>
                                                <!-- <option value="4"  @if ($question->current_answer_number == 4) selected @endif>Жауап D</option> -->
                                                <!-- <option value="5"  @if ($question->current_answer_number == 5) selected @endif>Жауап E</option> -->
                                            </select>
                                            @error('current_answer_number')
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
@endsection
