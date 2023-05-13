@extends('layouts/app')
@section('content')
    @component('client.components.breadcrumb')
        @slot('title')
            Тестілеу
        @endslot
        @slot('parent')
            Басты бет
        @endslot
        @slot('courses')
            Курстар тізімі
        @endslot
        @slot('course')
            {{$lesson->module->course->name}}
        @endslot
        @slot('course_route')
            {{ route('courses.show', $lesson->course_id) }}
        @endslot
        @slot('lesson')
            {{$lesson->name}}
        @endslot
        @slot('lesson_route')
            {{ route('courses.modules.lessons.show', ['course' => $lesson->module->course_id, 'module' => $lesson->module_id,'lesson' => $lesson->id]) }}
        @endslot
        @slot('active')
            Тестілеу
        @endslot
    @endcomponent
    <section class="questions">
        <div class="container">
            <div class="testing">
                <div class="testing-info">
                    <div class="title">
                        Тест тапсыруға дайынсыз ба?
                    </div>
                    <div class="warning">
                        Тест {{$lesson->questions_count}} сұрақтан тұрады
{{--                        @if($lesson->passing_test_percent)--}}
{{--                            <br>--}}
{{--                            Тестің--}}
{{--                            <span class="test-passing">{{$lesson->passing_test_percent}} %</span>-на дұрыс жауап берсеңіз келесі сабақ ашылады.--}}
{{--                        @endif--}}
                    </div>
                    <form
                        action="{{ route('lessons.test.store', ['course' => $lesson->module->course_id, 'lesson' => $lesson->id]) }}"
                        method="post">
                        @csrf
                        <button type="submit" class="btn default-btn">
                            Тест тапсыру
                        </button>
                    </form>
                    <span class="info">
                        Келесі батырманы бассаңыз тест <br> автоматты түрде басталады
                    </span>
                </div>
            </div>
        </div>
    </section>
@endsection
