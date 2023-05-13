<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@if(isset($title)) {{$title}} @endif</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @if(isset($parent))
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}"> <i class="fas fa-dashboard"></i>{{ $parent }}</a>
                        </li>
                    @endif
                    @if(isset($courses))
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.courses.index') }}">{{ $courses }}</a>
                        </li>
                    @endif
                    @if(isset($lessons))
                        <li class="breadcrumb-item">
                            <a href="{{ $lesson_course_route }}"> {{ $lessons }}</a>
                        </li>
                    @endif
                    @if(isset($questions))
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.questions.index') }}"> {{ $questions }}</a>
                        </li>
                    @endif
                    @if(isset($course_modules))
                        <li class="breadcrumb-item">
                            <a href="{{ $course_module_route }}">
                                {{ $course_modules }} - Модульдар тізімі
                            </a>
                        </li>
                    @endif
                    @if(isset($course_tasks))
                        <li class="breadcrumb-item">
                            <a href="{{ $course_tasks_route }}">
                                {{ $course_tasks }} - Модульдар тізімі
                            </a>
                        </li>
                    @endif
                    @if(isset($module_lessons))
                        <li class="breadcrumb-item">
                            <a href="{{ $module_lesson_route }}">
                                {{ $module_lessons }} - Сабақтар тізімі
                            </a>
                        </li>
                    @endif
                    @if(isset($lesson_questions))
                        <li class="breadcrumb-item">
                            <a href="{{ $lesson_question_route }}">
                                {{ $lesson_questions }} - Сұрақтар тізімі
                            </a>
                        </li>
                    @endif
                    @if(isset($comments))
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.comments.index') }}"> {{ $comments }}</a>
                        </li>
                    @endif
                    @if(isset($users))
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.users.index') }}"> {{ $users }}</a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active">{{ $active }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
