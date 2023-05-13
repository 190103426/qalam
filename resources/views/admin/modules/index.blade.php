@extends('layouts.admin')
@section('title', 'Админ панель - Курстар тізімі')
@section('custom_css')
    <style>
        tr th {
            line-height: 1;
        }
    </style>
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Модульдар тізімі @endslot
        @slot('parent') Басты бет @endslot
        @slot('courses') Курстар тізімі @endslot
        @slot('courses') Курстар тізімі @endslot
        @slot('active') {{ $course->name }} - Модульдар тізімі @endslot
    @endcomponent
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3  class="card-title ">Курс - {{ $course->name }}</h3>
                    <br>
                    <div class="btn-group right mt-2">
                        <a class="btn btn-success" href="{{route('admin.modules.create', ['course' => $course->id])}}">
                            <i class="fa fa-plus"></i> Қосу
                        </a>
                        <a class="btn btn-danger ml-2" href="{{route('admin.modules.index', ['course' => $course->id])}}">
                            <i class="fa fa-trash"></i>
                            Фильтрді тазалау
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
                                Аты
                            </th>
                            <th>Сабақтар</th>
                            <th>
                                Әрекет
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <form method="get" action="{{ route('admin.modules.index', ['course' => $course->id])}}">
                                <td></td>
                                <td>
                                    <input name="name" class="form-control" type="text"
                                           value="{{request()->input('name') }}" placeholder="Тақырыбы">
                                </td>
                                <td></td>
                                <td>
                                    <button class="w-100 btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i> Іздеу
                                    </button>
                                </td>
                            </form>
                        </tr>
                        @foreach ($modules as $key => $module)
                            <tr>
                                <td> {{$key + 1}}</td>
                                <td>
                                    {{ $module->name }}

                                </td>
                                <td align="center">
{{--                                    &nbsp;Сабақтар саны: {{ $module->lessons_count }}--}}
{{--                                    <hr>--}}
                                    <a href="{{ route('admin.lessons.index', ['course' => $module->course_id, 'module' => $module->id]) }}"
                                       class="btn btn-sm btn-info mb-2" title="Сабақтарға өту">
                                        Сабақтар тізімі <span class="badge ml-1 badge-warning">{{$module->lessons_count}} </span> <i class="nav-icon fas fa-list"></i>
                                    </a>
                                </td>

                                <td>
                                    <div class="d-flex" style="align-items: center;justify-content: center">
                                        <a class="btn btn-sm edit btn-outline-success mr-2" title="Изменить"
                                           href="{{ route('admin.modules.edit', ['course' => $module->course_id, 'module' => $module->id]) }}">
                                            <i class="fas fa-edit blue">
                                            </i>
                                        </a>
                                        <form class="edit mb-2" method="POST"
                                              action="{{route('admin.modules.destroy', ['course' => $module->course_id, 'module' => $module->id])}}"
                                              id="delete-form-{{$module->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="javascript:void(0)" type="submit"
                                                    id="{{$module->id}}"
                                                    class="btn btn-sm btn-danger mb-0  delete-btn delete" title="Удалить">
                                                <i onclick="javascript:void(0)" id="{{$module->id}}"
                                                   class="fas fa-trash">
                                                </i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @component('admin.components.pagination', ['paginator' => $modules])
                    @slot('text') модуль @endslot
                @endcomponent
            </div>
        </div>
    </section>
@endsection()
