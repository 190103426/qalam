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
        @slot('title') Курстар тізімі @endslot
        @slot('parent') Басты бет @endslot
        @slot('active') Курстар тізімі @endslot
    @endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-group">

                            <a class="btn btn-success" href="{{route('admin.courses.create')}}">
                                <i class="fa fa-plus"></i> Қосу
                            </a>
                            <a class="btn btn-danger ml-2" href="{{route('admin.courses.index')}}">
                                <i class="fa fa-trash"></i>
                                Фильтрді тазалау
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
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
                            <th>Модульдер</th>
{{--                            <th>Тест</th>--}}
                            <th>
                                Әрекет
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <form method="get" action="{{ route('admin.courses.index')}}">
                                <td></td>
                                <td>
                                    <input name="name" class="form-control" type="text"
                                           value="{{request()->input('name') }}" placeholder="Тақырыбы">
                                </td>
                                <td>
                                    <input name="description" class="form-control" type="text"
                                           value="{{request()->input('description') }}" placeholder="Сипаттамасы">
                                </td>
{{--                                <td></td>--}}
                                <td></td>
                                <td>
                                    <button class="w-100 btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i> Іздеу
                                    </button>
                                </td>
                            </form>
                        </tr>
                        @foreach ($courses as $key => $course)
                            <tr>
                                <td>
                                    {{ $courses->firstItem() + $key }}
                                </td>
                                <td>
                                    {{ $course->name }}
                                </td>
                                <td>
                                    {!!  $course->short_description  !!}
                                </td>
                                <td>

                                    <a href="{{ route('admin.modules.index', ['course' => $course->id]) }}" class="btn btn-sm btn-info mb-2" title="Модульдер тізімі">
                                        Модульдер тізімі   <span class="badge ml-1 badge-warning">{{$course->modules_count}} </span> <i class="nav-icon fas fa-list"></i>&nbsp;
                                    </a>

                                    <a href="{{ route('admin.courses.all_tasks', ['course' => $course->id]) }}" class="btn btn-sm btn-info mb-2" title="Модульдер тізімі">
                                        Жауаптар тізімі   <span class="badge ml-1 badge-warning">{{$course->lessons->pluck('tasks_count')->sum()}} </span> <i class="nav-icon fas fa-list"></i>&nbsp;
                                    </a>

                                </td>

                                <td class="d-flex" style="align-items: center;justify-content: center">
                                    <a class="btn btn-sm edit mb-1" title="Изменить"
                                       href="{{ route('admin.courses.edit', $course) }}">
                                        <i class="fas fa-edit blue">
                                        </i>
                                    </a>
                                    <form class="edit mb-2" method="POST"
                                          action="{{route('admin.courses.destroy', $course)}}"
                                          id="delete-form-{{$course->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="javascript:void(0)" type="submit"
                                                id="{{$course->id}}"
                                                class="btn  btn-sm delete-btn delete" title="Удалить">
                                            <i onclick="javascript:void(0)" id="{{$course->id}}"
                                               class="fas fa-trash">
                                            </i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @component('admin.components.pagination', ['paginator' => $courses])
                    @slot('text') курсов @endslot
                @endcomponent
            </div>
        </div>
    </section>
@endsection()
