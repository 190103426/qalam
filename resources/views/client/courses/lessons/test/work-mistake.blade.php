@extends('layouts/app')
@section('content')

    @component('client.components.breadcrumb')
        @slot('title')
            Қатемен жұмыс
        @endslot
        @slot('parent')
            Басты бет
        @endslot
        @slot('courses')
            Курстар тізімі
        @endslot
        @slot('course')
            {{$test->lesson->module->course->name}}
        @endslot
        @slot('course_route')
            {{ route('courses.show', $test->lesson->course_id) }}
        @endslot
        @slot('lesson')
            {{$test->lesson->name}}
        @endslot
        @slot('lesson_route')
            {{ route('courses.modules.lessons.show', ['course' => $test->lesson->module->course_id, 'module' => $test->lesson->module_id,'lesson' => $test->lesson->id]) }}
        @endslot
        @slot('active')Тестілеу@endslot
    @endcomponent

    <section class="questions">
        <div class="container">
            <div id="app">
                <course-test-work-mistake :test_data="{{$test}}"
                                          :text_right_title="{{ json_encode('Сұрақтар тізімі') }}"
                                          :text_title="{{ json_encode('Тест нәтижесі') }}"
                >
                </course-test-work-mistake>
            </div>
        </div>
    </section>
@endsection
@section('custom_js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
