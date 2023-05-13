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
        @slot('title') Cабақтар тізімі @endslot
        @slot('parent') Басты бет @endslot
        @slot('courses') Курстар тізімі @endslot
        @slot('course_modules') {{ $module->course->name }} @endslot
        @slot('course_module_route'){{ route('admin.modules.index',  ['course' => $module->course_id]) }}@endslot
        @slot('active') {{ $module->name }} - Cабақтар тізімі @endslot
    @endcomponent

    <section class="content">

        <div class="container-fluid">
            <div class="card">
                <div class="card-header space-between">
                    <h5>{{ $module->name }} модульнің сабақтар тізімі</h5>
                    <div class="btn-group">
                        <a href="{{ route('admin.lessons.create', [ 'course' => $module->course_id, 'module' => $module->id]) }}"
                           class="btn btn-success">
                            <i class="fa fa-plus"></i>
                            Сабақ қосу
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered projects">
                        <thead>
                        <tr>
                            <th style="width: 7%;">
                                #
                            </th>
                            <th>
                                Аты
                            </th>
                            <th>Сипаттамасы</th>
                            <th>Сұрақтар</th>
                            <th>
                                Әрекет
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($module->lessons as $key => $lesson)
                            <tr>
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    {{ $lesson->name }}
                                    @if(!empty($lesson->task) || $lesson->tasks_count)
                                        <hr>
                                        <a href="{{ route('admin.lessons.tasks.index',
                                          [
                                              'course' => $module->course_id,
                                              'module' => $module->id,
                                              'lesson' => $lesson->id
                                          ]) }}" class="btn ml-2 btn-sm btn-warning" title="Сұрақтар тізімі">

                                            Тапсырма жауаптары   <span class="badge ml-1 badge-info">{{$lesson->tasks_count}} </span>  <i class="nav-icon fas fa-users"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {!!  $lesson->short_description  !!}
                                </td>
                                <td align="center">
                                    <a href="{{ route('admin.lessons.questions.index',
                                          [
                                              'course' => $module->course_id,
                                              'module' => $module->id,
                                              'lesson' => $lesson->id
                                          ]) }}" class="btn btn-sm btn-info mb-2" title="Сұрақтар тізімі">

                                        Сұрақтар тізімі <span class="badge ml-1 badge-warning">{{$lesson->questions_count}} </span> <i class="nav-icon fas fa-list"></i> &nbsp;
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex" style="align-items: center;justify-content: center">
                                        <a class="btn btn-sm edit btn-outline-success mr-2" title="Изменить"
                                           href="{{ route('admin.lessons.edit', [
                                                    'course' => $module->course_id,
                                                     'module' => $module->id,
                                                     'lesson' => $lesson->id
                                                     ]) }}">
                                            <i class="fas fa-edit blue">
                                            </i>
                                        </a>
                                        <form class="edit" method="POST"
                                              action="{{route('admin.lessons.destroy', [
                                                    'course' => $module->course_id,
                                                     'module' => $module->id,
                                                     'lesson' => $lesson->id
                                                     ])}}"
                                              id="delete-form-{{$lesson->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="javascript:void(0)" type="submit"
                                                    id="{{$lesson->id}}"
                                                    class="btn  btn-sm btn-danger mb-0 delete-btn delete" title="Удалить">
                                                <i onclick="javascript:void(0)" id="{{$lesson->id}}"
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
                                    Сабақтар бос
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
