@extends('layouts.admin')
@section('title', 'Админ панель - Қолданушыға доступ ашу')
@section('custom_css')
    <style>
        tr th {
            line-height: 1;
        }
    </style>
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Қолданушылар тізімі @endslot
        @slot('parent') Басты бет @endslot
        @slot('users') Қолданушылар тізімі @endslot
        @slot('active') Қолданушыға доступ ашу @endslot
    @endcomponent

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title"> Курска доступ - {{ ($user->full_name) ?? '' }}</h3>
                        </div>
                        <br>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <table id=""
                                               class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Курстың атауы</th>
                                                <th>Доступ берілген уақыт</th>
                                                <th>Доступ жабылатын уақыт</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($courses as $key => $course)
                                                @if(!empty($course->accessCourses)  && $course->accessCourses->to_date >= now())
                                                    <tr>
                                                        <td>
                                                            {{$key+1}}
                                                        </td>
                                                        <td>
                                                            {{$course->name}}
                                                        </td>
                                                        <td>
                                                            {{$course->accessCourses->created_at}}
                                                        </td>
                                                        <td>
                                                            {{$course->accessCourses->to_date}}
                                                        </td>

                                                        <td>

                                                            <form class="edit mb-2" method="POST"
                                                                  action="{{ route('admin.users.access_course_delete',
                                                                    ['id'=>$user->id,'access_id' => $course->accessCourses->id]) }}"
                                                                  id="delete-form-{{$course->accessCourses->id}}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button onclick="javascript:void(0)" type="submit"
                                                                        id="{{$course->accessCourse}}"
                                                                        class="btn  btn-sm delete-btn delete"
                                                                        title="Удалить">
                                                                    <i onclick="javascript:void(0)"
                                                                       id="{{ $course->accessCourses->id }}"
                                                                       class="fas fa-trash">
                                                                    </i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('admin.users.access_course_give', $user->id)}}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="course_id">Курстар тізімі</label>
                                            @if(count($courses->filter(fn($item) => !$item->accessCourses)))
                                                <select name="course_id" class="form-control">


                                                    <option disabled selected>Курсты таңдаңыз</option>
                                                    @foreach($courses as $key => $course)

                                                        @if(!$course->accessCourses || empty($course->accessCourses) || ($course->accessCourses && !($course->accessCourses->to_date >= now())))
                                                            <option value="{{$course->id}}">
                                                                {{$course->name}}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('course_id')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            @else
                                                <input type="text" class="form-control" value="{{ count($courses) ? 'Барлық курсқа доступ берілді' : 'Курстар бос'}}" disabled>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="day_count">Күн</label>
                                            <input type="number" name="days_count"
                                                   class="form-control" id="days_count"
                                                   placeholder="" value="30">
                                            @error('days_count')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="nav-icon fas fa-key"></i> &nbsp;
                                    Доступ беру
                                </button>
                                <a class="btn btn-danger"
                                   href="{{ redirect()->getUrlGenerator()->previous() }}">Артқа</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection()
