@extends('layouts.admin')
@section('title', 'Админ панель - Cабақтар тізімі')
@section('custom_css')
    <style>
        tr th {
            line-height: 1;
        }
    </style>
@endsection
@php $changeTask = null
    @endphp
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Жауаптар тізімі @endslot
        @slot('parent') Басты бет @endslot
        @slot('courses') Курстар тізімі @endslot
        @slot('course_modules') {{ $lesson->module->course->name }} @endslot
        @slot('course_module_route'){{ route('admin.modules.index',  ['course' => $lesson->module->course_id]) }}@endslot
        @slot('module_lessons') {{ $lesson->module->name }} @endslot
        @slot('module_lesson_route'){{ route('admin.lessons.index',  ['course' => $lesson->module->course_id, 'module' => $lesson->module_id]) }}@endslot
        @slot('active') {{ $lesson->name }} - Жауаптар тізімі @endslot
    @endcomponent

    <section class="content">

        <div class="container-fluid">
            <div class="card">
                <div class="card-header space-between">
                    <h5>{{ $lesson->name }} сабағының жауаптар тізімі</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered projects">
                        <thead>
                        <tr>
                            <th style="width: 7%;">
                                ID
                            </th>
                            <th>
                                Аты-жөні
                            </th>
                            <th>
                                Телефон
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Уақыты
                            </th>
                            <th>
                                Қабылдау
                            </th>
                            <th>
                                Әрекет
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($lesson->tasks as $key => $task)
                            <tr id="parent{{ $key }}">
                                <td class="id d-none">
                                    {{ $task->id }}
                                </td>
                                <td class="lesson_id d-none">
                                    {{ $lesson->id }}
                                </td>
                                <td>
                                    {{  $key + 1 }}
                                </td>
                                <td class="full_name">
                                    {{ $task->user->full_name }}
                                </td>
                                <td class="phone">
                                    {{ $task->user->phone }}
                                </td>
                                <td  class="email">
                                    {{ $task->user->email }}
                                </td>
                                <td>
                                    {{ $task->created_at?->format('d.m.Y H:i') }}
                                </td>
                                <td class="result">
                                    {{ $task->result == 'success'  ? "Қабылданды" : ($task->result == 'failed' ? 'Қабылданбады' : 'Таңдалмады') }}
                                </td>
                                <td class="file_1 d-none">{{$task->file_1}}</td>
                                <td class="file_2 d-none">{{$task->file_2}}</td>
                                <td class="file_3 d-none">{{$task->file_3}}</td>
                                <td class="comment d-none">{{$task->comment ?? 'Пікір қалдырмаған'}}</td>
                                <td class="comment_teacher d-none">
                                    {{$task->comment_teacher}}
                                </td>
                                <td class="text-center">
                                    <button
                                        onclick="getView({{ $key }})"
                                        class="btn btn-sm btn-outline-primary mb-0 view"
                                        data-toggle="modal"
                                        data-idView="{{$task->id}}" data-target="#view"
                                        title="Толығырақ">
                                        <i class="nav-icon fas fa-eye"></i>
                                    </button>

                                    <button
                                        onclick="getUpdate({{ $key }})"
                                        class="btn btn-sm btn-outline-success mb-0 edit" title="Өзгерту"
                                        data-toggle="modal"
                                        data-idUpdate="{{$task->id}}" data-target="#update">
                                        <i class="nav-icon fas fa-edit"></i>
                                    </button>

                                    <form class="d-inline-block edit mb-0" method="POST"
                                          action="{{route('admin.lessons.tasks.destroy', [
                                                                            'course' => request()->route('course'),
                                                                            'module' => $lesson->module_id,
                                                                            'lesson' => $lesson->id,
                                                                            'task' => $task->id,
                                                                        ])}}"
                                          id="delete-form-{{$task->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="javascript:void(0)" type="submit"
                                                id="{{$task->id}}"
                                                class="btn btn-sm btn-danger delete" title="Удалить">
                                            <i onclick="javascript:void(0)" id="{{$task->id}}"
                                               class="fas fa-trash">
                                            </i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    Жауаптар бос
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="view" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header text-write">
                        <h4 class="modal-title">Үй тапсырмасын тексеру</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-4 ">Аты-жөні</label>
                                <div class="col-sm-8 ">
                                    <span class="form-group" id="full_name_view"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 ">Телефон</label>
                                <div class="col-sm-8">
                                    <span id="phone_view"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 ">E-mail</label>
                                <div class="col-sm-8">
                                    <span id="email_view"></span>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Үй тапсырмасы</label>
                                <div class="col-sm-8">

                                    <a id="file_view_1" name="file_view_1" href="javascript:void(0)"
                                       class="btn btn-danger mb-1 mt-1">
                                        <i class="nav-icon fas fa-download"></i> &nbsp;
                                        Жүктеу
                                    </a>

                                    <a id="file_view_2" name="file_view_2" href="javascript:void(0)"
                                       class="btn btn-danger mb-1 mt-1">
                                        <i class="nav-icon fas fa-download"></i> &nbsp;
                                        Жүктеу
                                    </a>

                                    <a id="file_view_3" name="file_view_3" href="javascript:void(0)"
                                       class="btn btn-danger mb-1 mt-1">
                                        <i class="nav-icon fas fa-download"></i> &nbsp;
                                        Жүктеу
                                    </a>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 ">Пікірі</label>
                                <div class="col-sm-12">
                                    <span id="comment_view"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 " for="comment_teacher">Пікірге жауабыңыз</label>
                                <div class="col-sm-12">
                                    <span id="comment_teacher_view"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 " for="result">Қабылдау</label>
                                <div class="col-sm-12">
                                    <span id="result"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="nav-icon fas fa-times-circle mr-2"></i> Жабу
                            </button>
                        </div>
                </div>
            </div>
        </div>
        <!-- Modal Update-->
        <div class="modal fade" id="update" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header text-write">
                        <h4 class="modal-title">Үй тапсырмасын тексеру</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </div>
                    <form id="updateTask" action="" method="post">
                        @csrf
                        @method("PUT")
                        <input type="text" hidden class="col-sm-9 form-control" id="id" name="id" value=""/>
                        <div class="modal-body">

                            <div class="form-group row">
                                <label class="col-sm-3 ">Аты-жөні</label>
                                <div class="col-sm-9 ">
                                    <span class="form-group" id="full_name"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 ">Телефон</label>
                                <div class="col-sm-9">
                                    <span id="phone"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 ">E-mail</label>
                                <div class="col-sm-9">
                                    <span id="email"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Үй тапсырмасы</label>
                                <div class="col-sm-9">

                                    <a id="file_1" name="file_2" href=""
                                       class="btn btn-danger mb-1 mt-1">
                                        <i class="nav-icon fas fa-download"></i> &nbsp;
                                        Жүктеу
                                    </a>

                                    <a id="file_2" name="file_2" href=""
                                       class="btn btn-danger mb-1 mt-1">
                                        <i class="nav-icon fas fa-download"></i> &nbsp;
                                        Жүктеу
                                    </a>

                                    <a id="file_3" name="file_3" href=""
                                       class="btn btn-danger mb-1 mt-1">
                                        <i class="nav-icon fas fa-download"></i> &nbsp;
                                        Жүктеу
                                    </a>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 ">Пікірі</label>
                                <div class="col-sm-9">
                                    <span id="comment"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="comment_teacher">Пікірге жауабын жазыңыз</label>
                                    <textarea class="form-control" name="comment_teacher" id="comment_teacher" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="comment_teacher">Қабылдау</label>
                                    <select class="form-control" name="result" id="result">
                                        <option value="">Таңдалмады</option>
                                        <option value="{{ \App\Models\LessonTask::SUCCESS_RESULT }}">Қабылдау</option>
                                        <option value="{{ \App\Models\LessonTask::FAILED_RESULT }}">Қабылдамау</option>
                                    </select>
{{--                                    <textarea class="form-control" name="comment_teacher" id="comment_teacher" rows="3"></textarea>--}}
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="nav-icon fas fa-times-circle mr-2"></i> Жабу
                            </button>
                            <button type="submit"  id="" name="" class="btn btn-success  waves-light">
                                <i class="nav-icon fas fa-check-circle mr-2"></i> Сақтау
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection()

@section('admin_js')
    <script>
        function updateTask() {
            let id = $('#id').val()
            let action = "{{ route('admin.lessons.tasks.update', [
                            'course' => $lesson->module->course_id,
                            'module' => $lesson->module_id,
                            'lesson' => $lesson->id,
                            'task' => ':id'
                        ])}}"

             action = action.replace(':id', parseInt(id));
            if(id) {
                $('#updateTask').action = action
                $('#updateTask').method = "PUT"
                $('#updateTask').submit()
            }

        }
        function getUpdate(id) {
            $('#file_1').attr('href', '#');
            $('#file_2').attr('href', '#');
            $('#file_3').attr('href', '#');

            var _this = $('#parent' + id);
            let action = "{{ route('admin.lessons.tasks.update', [
                            'course' => $lesson->module->course_id,
                            'module' => $lesson->module_id,
                            'lesson' => $lesson->id,
                            'task' => ':id'
                        ])}}"

            var task_id = parseInt(_this.find('.id').text())
            var lesson_id = parseInt(_this.find('.lesson_id').text())
            action = action.replace(':id', task_id);
            $('#updateTask').attr('action', action)

            $('#id').val(task_id);
            $('#full_name').text(_this.find('.full_name').text().trim());
            $('#phone').text(_this.find('.phone').text().trim());
            $('#email').text(_this.find('.email').text().trim());
            $('#comment').text(_this.find('.comment').text().trim());
            $('#comment_teacher').val(_this.find('.comment_teacher').text().trim());
            // $('#result').val(_this.find('.result').text().trim()).change();
             result = _this.find('.result').text().trim()
            console.log('pre result',result)

            result = result === "Қабылданды" ? "{{ \App\Models\LessonTask::SUCCESS_RESULT }}" : (result == 'Қабылданбады' ? "{{ \App\Models\LessonTask::FAILED_RESULT }}" : '')
            if (!result) {
                $("#result option:selected").removeAttr("selected");
            } else {
                $('#result option[value='+result+']').attr('selected','selected');
            }


            var file_1 = _this.find('.file_1').text()
            var file_2 = _this.find('.file_2').text()
            var file_3 = _this.find('.file_3').text()
            var result = _this.find('.result').text()
            let base_route = `{{ route('downloadFile', ['path' =>\App\Models\LessonTask::FILES_PATH])}}` + '/'+ lesson_id +'/'
            if (!file_1) {
                if(!$('#file_1').hasClass('d-none')) {
                    $('#file_1').addClass('d-none')
                }
            } else {
                if($('#file_1').hasClass('d-none')) {
                    $('#file_1').removeClass('d-none')
                }
                $('#file_1').html('<i class="nav-icon fas fa-download"></i> &nbsp;\n' + 'Жүктеу');
                let route = base_route + file_1.trim()
                $('#file_1').attr('href', route);
            }


            if (!file_2) {
                if(!$('#file_2').hasClass('d-none')) {
                    $('#file_2').addClass('d-none')
                }
            } else {
                if($('#file_2').hasClass('d-none')) {
                    $('#file_2').removeClass('d-none')
                }
                $('#file_2').html('<i class="nav-icon fas fa-download"></i> &nbsp;\n' + 'Жүктеу');
                let route = base_route + file_2.trim()
                $('#file_2').attr('href', route);
            }

            if (!file_3) {
                if(!$('#file_3').hasClass('d-none')) {
                    $('#file_3').addClass('d-none')
                }
            } else {
                if($('#file_3').hasClass('d-none')) {
                    $('#file_3').removeClass('d-none')
                }
                $('#file_3').html('<i class="nav-icon fas fa-download"></i> &nbsp;\n' + 'Жүктеу');
                let route = base_route + file_3.trim()
                $('#file_3').attr('href', route);
            }
            if(!file_1 && !file_2 && !file_3) {
                $('#file_1').removeClass('d-none')
                $('#file_1').html('<i class="nav-icon fas fa-info-circle"></i> &nbsp;\n' + 'Тапсырма жүктемеген');
                $('#file_2').addClass('d-none')
                $('#file_3').addClass('d-none')
            }
        }

        function getView(id) {
            $('#file_view_1').attr('href', 'javascript:void(0)');
            $('#file_view_2').attr('href', 'javascript:void(0)');
            $('#file_view_3').attr('href', 'javascript:void(0)');

            var _this = $('#parent' + id);

            $('#full_name_view').text(_this.find('.full_name').text());
            $('#phone_view').text(_this.find('.phone').text());
            $('#email_view').text(_this.find('.email').text());
            $('#comment_view').text(_this.find('.comment').text());
            $('#comment_teacher_view').text(_this.find('.comment_teacher').text());
            $('#result').text(_this.find('.result').text());

            var lesson_id = parseInt(_this.find('.lesson_id').text())

            var file_1 = _this.find('.file_1').text()
            var file_2 = _this.find('.file_2').text()
            var file_3 = _this.find('.file_3').text()
            let base_route = `{{ route('downloadFile', ['path' =>\App\Models\LessonTask::FILES_PATH])}}` + '/'+ lesson_id +'/'

            if (!file_1) {
                if(!$('#file_view_1').hasClass('d-none')) {
                    $('#file_view_1').addClass('d-none')
                }
            } else {
                if($('#file_view_1').hasClass('d-none')) {
                    $('#file_view_1').removeClass('d-none')
                }
                $('#file_view_1').html('<i class="nav-icon fas fa-download"></i> &nbsp;\n' + 'Жүктеу');
                var route = base_route + file_1.trim();
                $('#file_view_1').attr('href', route);
            }

            if (!file_2) {
                if(!$('#file_view_2').hasClass('d-none')) {
                    $('#file_view_2').addClass('d-none')
                }
            } else {
                if($('#file_view_2').hasClass('d-none')) {
                    $('#file_view_2').removeClass('d-none')
                }
                $('#file_view_2').html('<i class="nav-icon fas fa-download"></i> &nbsp;\n' + 'Жүктеу');
                var route = base_route + file_2.trim();
                $('#file_view_2').attr('href', route);
            }

            if (!file_3) {
                if(!$('#file_view_3').hasClass('d-none')) {
                    $('#file_view_3').addClass('d-none')
                }
            } else {
                if($('#file_view_3').hasClass('d-none')) {
                    $('#file_view_3').removeClass('d-none')
                }
                $('#file_view_3').html('<i class="nav-icon fas fa-download"></i> &nbsp;\n' + 'Жүктеу');
                var route = base_route + file_3.trim();
                $('#file_view_3').attr('href', route);
            }

            if(isNaN(file_1) && isNaN(file_2) && isNaN(file_3)) {
                $('#file_view_1').removeClass('d-none')
                $('#file_view_1').html('<i class="nav-icon fas fa-info-circle"></i> &nbsp;\n' + 'Тапсырма жүктемеген');
                $('#file_view_2').addClass('d-none')
                $('#file_view_3').addClass('d-none')
            }

        }
    </script>
@endsection
