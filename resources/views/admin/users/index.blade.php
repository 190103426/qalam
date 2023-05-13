@extends('layouts.admin')
@section('title', 'Админ панель - Қолданушылар тізімі')
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
        @slot('active') Қолданушылар тізімі @endslot
    @endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-group">

                            <a class="btn btn-success" href="{{route('admin.users.create')}}">
                                <i class="fa fa-plus"></i> Қосу
                            </a>
                            <a class="btn btn-danger ml-2" href="{{route('admin.users.index')}}">
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
                                Аты-жөні
                            </th>
                            <th>Почта</th>
                            <th>Телефон</th>
                            <th>Рөл</th>
                            <th>Доступ ашу</th>
                            <th>
                                Әрекет
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <form method="get" action="{{ route('admin.users.index')}}">
                                <td></td>
                                <td>
                                    <input name="full_name" class="form-control" type="text"
                                           value="{{request()->input('full_name') }}" placeholder="Аты-жөні	">
                                </td>
                                <td>
                                    <input name="email" class="form-control" type="text"
                                           value="{{request()->input('email') }}" placeholder="Почта">
                                </td>
                                <td>
                                    <input name="phone" class="form-control" type="text"
                                           value="{{request()->input('phone') }}" placeholder="Телефон">
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="w-100 btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i> Іздеу
                                    </button>
                                </td>
                            </form>
                        </tr>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>
                                    {{ $users->firstItem() + $key }}
                                </td>
                                <td>{{$user->full_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    {{ preg_replace('~.*(\d{1})(\d{3})(\d{3})(\d{2})(\d{2}).*~', '+$1 ($2)-$3-$4-$5', $user->phone)}}
                               </td>
                               <td>
{{--                                    <button class="btn btn-sm"--}}
{{--                                            style="color: {{ $user->is_admin ? '#ffc107' : '#28a745'}}">--}}
{{--                                        <i class="nav-icon fas fa-user"></i> &nbsp;--}}
{{--                                        <b>{{ $user->is_admin ? 'Админ' : 'Қолданушы'}}</b>--}}
{{--                                    </button>--}}
                                    <form class="w-100 " method="post"
                                          action="{{route('admin.users.change_role', $user->id)}}">
                                        @csrf       @method('POST')
                                        <button type="submit" class="w-100 btn  btn-sm edit mb-1
                                                {{ $user->is_admin  ? 'btn-success' : 'btn-warning'}}">
                                            <i class="fas fas fa-edit ">
                                            </i>
                                            {{$user->is_admin ?   'Админ' : 'Қолданушы' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{route('admin.users.access_courses',['id'=>$user->id])}}"
                                       type="button"
                                       class="btn btn-block btn-sm btn-success"
                                    >
                                        <i class="nav-icon fas fa-key"></i> &nbsp;
                                        Доступ ашу
                                    </a>
                                </td>
                                <td class="d-flex" style="align-items: center;justify-content: center; border:none;">
                                    @if($user->id != auth()->user()->id)
                                        <a class="btn btn-sm edit mb-1" title="Изменить"
                                           href="{{ route('admin.users.edit', $user) }}">
                                            <i class="fas fa-edit blue">
                                            </i>
                                        </a>
                                        <form class="edit mb-2" method="POST"
                                              action="{{route('admin.users.destroy', $user)}}"
                                              id="delete-form-{{$user->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="javascript:void(0)" type="submit"
                                                    id="{{$user->id}}"
                                                    class="btn  btn-sm delete-btn delete" title="Удалить">
                                                <i onclick="javascript:void(0)" id="{{ $user->id }}"
                                                   class="fas fa-trash">
                                                </i>
                                            </button>
                                        </form>
                                    @else
                                        ---
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @component('admin.components.pagination', ['paginator' => $users])
                    @slot('text') пользователей @endslot
                @endcomponent
            </div>
        </div>
    </section>

@endsection()
