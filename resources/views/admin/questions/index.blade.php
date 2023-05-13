@extends('layouts.admin')
@section('title', 'Админ панель - Сұрақтар тізімі')
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
        @slot('active') Сұрақтар тізімі @endslot
    @endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-group">

                            <a class="btn btn-success" href="{{route('admin.questions.create')}}">
                                <i class="fa fa-plus"></i> Қосу
                            </a>
                            <a class="btn btn-danger ml-2" href="{{route('admin.questions.index')}}">
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
                                Сұрақ
                            </th>
                            <th>Жауап</th>
                            <th>
                                Әрекет
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <form method="get" action="{{ route('admin.questions.index')}}">
                                <td></td>
                                <td>
                                    <input name="text" class="form-control" type="text"
                                           value="{{request()->input('text') }}" placeholder="Сұрақ">
                                </td>
                                <td>
                                    <input name="answer" class="form-control" type="text"
                                           value="{{request()->input('answer') }}" placeholder="Жауап">
                                </td>
                                <td>
                                    <button class="w-100 btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i> Іздеу
                                    </button>
                                </td>
                            </form>
                        </tr>
                        @foreach ($questions as $key => $question)
                            <tr>
                                <td>
                                    {{ $questions->firstItem() + $key }}

                                </td>
                                <td>
                                    {!!  $question->text  !!}
                                </td>
                                <td>
                                    {!! $question->short_answer !!}
                                </td>
                                <td class="d-flex" style="align-items: center;justify-content: center">
                                    <a class="btn btn-sm edit mb-1" title="Изменить"
                                       href="{{ route('admin.questions.edit', $question) }}">
                                        <i class="fas fa-edit blue">
                                        </i>
                                    </a>
                                    <form class="edit mb-2" method="POST"
                                          action="{{route('admin.questions.destroy', $question)}}"
                                          id="delete-form-{{$question->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="javascript:void(0)" type="submit"
                                                id="{{$question->id}}"
                                                class="btn  btn-sm delete-btn delete" title="Удалить">
                                            <i onclick="javascript:void(0)" id="{{$question->id}}"
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
                @component('admin.components.pagination', ['paginator' => $questions])
                    @slot('text')  @endslot
                @endcomponent
            </div>
        </div>
    </section>
@endsection()
