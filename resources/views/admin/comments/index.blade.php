@extends('layouts.admin')
@section('title', 'Админ панель - Заказы')
@section('custom_css')
    <style>
        tr th {
            line-height: 1;
        }
    </style>
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Піркір тізімі @endslot
        @slot('parent') Басты бет @endslot
        @slot('active') Піркір тізімі @endslot
    @endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-group">

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
                                ID
                            </th>
                            <th>
                                Аты
                            </th>
                            <th>Пікір</th>
                            <th>Курс - сабақ</th>
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
                                    <input name="full_name" class="form-control" type="text"
                                           value="{{request()->input('full_name') }}" placeholder="Аты">
                                </td>
                                <td>
                                    <input name="text" class="form-control" type="text"
                                           value="{{request()->input('text') }}" placeholder="Пікір">
                                </td>
                                <td></td>
                                <td>
                                    <button class="w-100 btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i> Іздеу
                                    </button>
                                </td>
                            </form>
                        </tr>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>
                                    {{ $comment->id }}
                                </td>
                                <td>
                                    {{ $comment->full_name }}
                                </td>
                                <td>
                                    {{ $comment->text }}
                                </td>
                                <td>
                                    Курс "{{ $comment->lesson->name }}" - {{ $comment->lesson->course->name }}

                                </td>

                                <td class="d-flex" style="align-items: center;justify-content: center">
                                    <a class="btn btn-sm edit mb-1" title="Изменить"
                                       href="{{ route('admin.comments.edit', $comment) }}">
                                        <i class="fas fa-edit blue">
                                        </i>
                                    </a>
                                    <form class="edit mb-2" method="POST"
                                          action="{{route('admin.comments.destroy', $comment)}}"
                                          id="delete-form-{{$comment->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="javascript:void(0)" type="submit"
                                                id="{{$comment->id}}"
                                                class="btn  btn-sm delete-btn delete" title="Удалить">
                                            <i onclick="javascript:void(0)" id="{{$comment->id}}"
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
                @component('admin.components.pagination', ['paginator' => $comments])
                    @slot('text') пікір @endslot
                @endcomponent
            </div>
        </div>
    </section>

@endsection()
