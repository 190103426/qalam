@extends('layouts.admin')
@section('title', 'Админ панель - Cабақтар тізімі')
@section('custom_css')
    <style>
        tr th {
            line-height: 1;
        }
    </style>
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Сұрақтар тізімі @endslot
        @slot('parent') Басты бет @endslot
        @slot('courses') Курстар тізімі @endslot
        @slot('course_modules') {{ $lesson->module->course->name }} @endslot
        @slot('course_module_route'){{ route('admin.modules.index',  ['course' => $lesson->module->course_id]) }}@endslot
        @slot('module_lessons') {{ $lesson->module->name }} @endslot
        @slot('module_lesson_route'){{ route('admin.lessons.index',  ['course' => $lesson->module->course_id, 'module' => $lesson->module_id]) }}@endslot
        @slot('active') {{ $lesson->name }} - Сұрақтар тізімі @endslot
    @endcomponent

    <section class="content">

        <div class="container-fluid">
            <div class="card">
                <div class="card-header space-between">
                    <h5>{{ $lesson->name }} сабағының сұрақтар тізімі</h5>
                    <div class="btn-group">
                        <a href="{{ route('admin.lessons.questions.create', [
                                                                            'course' => request()->route('course'),
                                                                            'module' => $lesson->module_id,
                                                                            'lesson' => $lesson->id,
                                                                        ]) }}" class="btn btn-success">
                            <i class="fa fa-plus"></i>
                            Сұрақ қосу
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered projects">
                        <thead>
                        <tr>
                            <th style="width: 7%;">
                                №
                            </th>
                            <th>
                                Сұрақ
                            </th>
                            <th>
                                Әрекет
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($lesson->questions as $key => $question)
                            <tr>
                                <td>
                                    {{ ++$key }}
                                </td>
                                <td>
                                    {!! $question->text !!}
                                </td>
                                <td>
                                    <div class="d-flex" style="align-items: center;justify-content: center">
                                        <a class="btn btn-sm edit btn-outline-success mr-2" title="Изменить"
                                           href="{{ route('admin.lessons.questions.edit',  [
                                                                            'course' => request()->route('course'),
                                                                            'module' => $lesson->module_id,
                                                                            'lesson' => $lesson->id,
                                                                            'question' => $question->id,
                                                                        ]) }}">
                                            <i class="fas fa-edit blue">
                                            </i>
                                        </a>
                                        <form class="edit" method="POST"
                                              action="{{route('admin.lessons.questions.destroy', [
                                                                            'course' => request()->route('course'),
                                                                            'module' => $lesson->module_id,
                                                                            'lesson' => $lesson->id,
                                                                            'question' => $question->id,
                                                                        ])}}"
                                              id="delete-form-{{$question->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="javascript:void(0)" type="submit"
                                                    id="{{$question->id}}"
                                                    class="btn  btn-sm btn-danger mb-0 delete-btn delete"
                                                    title="Удалить">
                                                <i onclick="javascript:void(0)" id="{{$question->id}}"
                                                   class="fas fa-trash">
                                                </i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    Сұрақтар бос
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection()
