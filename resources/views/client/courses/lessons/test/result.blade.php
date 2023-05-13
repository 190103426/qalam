@extends('layouts/app')
@section('content')

    @component('client.components.breadcrumb')
        @slot('title') Тестілеу нәтижесі @endslot
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
        @slot('active')
            Тестілеу
        @endslot
    @endcomponent
    <section class="questions">
        <div class="container">
            <div class="testing-result">
                <img src="{{ asset('images/check.png') }}" class="check" alt="check.png">
                <div class="result-message">

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.35 2H9.65001C8.61001 2 7.76001 2.84 7.76001 3.88V4.82C7.76001 5.86 8.60001 6.7 9.64001 6.7H14.35C15.39 6.7 16.23 5.86 16.23 4.82V3.88C16.24 2.84 15.39 2 14.35 2Z" fill="#11A50E"/>
                        <path d="M17.24 4.82001C17.24 6.41001 15.94 7.71001 14.35 7.71001H9.65004C8.06004 7.71001 6.76004 6.41001 6.76004 4.82001C6.76004 4.26001 6.16004 3.91001 5.66004 4.17001C4.25004 4.92001 3.29004 6.41001 3.29004 8.12001V17.53C3.29004 19.99 5.30004 22 7.76004 22H16.24C18.7 22 20.71 19.99 20.71 17.53V8.12001C20.71 6.41001 19.75 4.92001 18.34 4.17001C17.84 3.91001 17.24 4.26001 17.24 4.82001ZM12.38 16.95H8.00004C7.59004 16.95 7.25004 16.61 7.25004 16.2C7.25004 15.79 7.59004 15.45 8.00004 15.45H12.38C12.79 15.45 13.13 15.79 13.13 16.2C13.13 16.61 12.79 16.95 12.38 16.95ZM15 12.95H8.00004C7.59004 12.95 7.25004 12.61 7.25004 12.2C7.25004 11.79 7.59004 11.45 8.00004 11.45H15C15.41 11.45 15.75 11.79 15.75 12.2C15.75 12.61 15.41 12.95 15 12.95Z" fill="#11A50E"/>
                    </svg>
                    Жалпы сұрақтар саны: {{ $test->user_answers_count }}
                </div>

                @if($test->lesson->passing_test_percent)
                    <div class="result-message">  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.35 2H9.65001C8.61001 2 7.76001 2.84 7.76001 3.88V4.82C7.76001 5.86 8.60001 6.7 9.64001 6.7H14.35C15.39 6.7 16.23 5.86 16.23 4.82V3.88C16.24 2.84 15.39 2 14.35 2Z" fill="#11A50E"/>
                            <path d="M17.24 4.82001C17.24 6.41001 15.94 7.71001 14.35 7.71001H9.65004C8.06004 7.71001 6.76004 6.41001 6.76004 4.82001C6.76004 4.26001 6.16004 3.91001 5.66004 4.17001C4.25004 4.92001 3.29004 6.41001 3.29004 8.12001V17.53C3.29004 19.99 5.30004 22 7.76004 22H16.24C18.7 22 20.71 19.99 20.71 17.53V8.12001C20.71 6.41001 19.75 4.92001 18.34 4.17001C17.84 3.91001 17.24 4.26001 17.24 4.82001ZM12.38 16.95H8.00004C7.59004 16.95 7.25004 16.61 7.25004 16.2C7.25004 15.79 7.59004 15.45 8.00004 15.45H12.38C12.79 15.45 13.13 15.79 13.13 16.2C13.13 16.61 12.79 16.95 12.38 16.95ZM15 12.95H8.00004C7.59004 12.95 7.25004 12.61 7.25004 12.2C7.25004 11.79 7.59004 11.45 8.00004 11.45H15C15.41 11.45 15.75 11.79 15.75 12.2C15.75 12.61 15.41 12.95 15 12.95Z" fill="#11A50E"/>
                        </svg>

                        Тесттен өту балы: {{ $test->lesson->passing_test_percent }}%
                    </div>
                @endif
                <div class="user-answers">
                    <div class="title">
                        Сіз тесттен {{ $test->correct_answers_count }} балл жинадыңыз
                    </div>

                    <div class="user-answer">
                        <span>

                        Дұрыс жауаптар: {{ $test->correct_answers_count }}
                        </span>
                        <span>
                        Қате жауаптар: {{ $test->incorrect_answers_count }}
                    </span>
                    </div>
                </div>



                <div class="buttons">

                    <form method="POST"
                          action="{{route('lessons.test.store', ['course' => $test->lesson->module->course_id, 'lesson' => $test->lesson->id])}}">
                        @csrf
                        <button class="btn default-btn" type="submit">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.9834 4.29996H14.5168C15.9001 4.29996 17.0168 5.41662 17.0168 6.79996V9.56663" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.61673 1.66666L2.9834 4.29997L5.61673 6.93333" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17.0168 15.7H5.4834C4.10007 15.7 2.9834 14.5834 2.9834 13.2V10.4333" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14.3833 18.3333L17.0166 15.7L14.3833 13.0667" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            Қайта тапсыру
                        </button>
                    </form>
                    <a class="btn btn default-btn" href="{{ route('lessons.test.workMistake', [
                                                    'course' => $test->lesson->module->course_id,
                                                     'lesson' => $test->lesson->id,
                                                     'uuid' => $test->uuid
                                                     ]) }}">
                        Қателермен жұмыс
                    </a>
{{--                    @if($test->score >= $test->lesson->passing_test_percent)--}}
                        <a class="btn white-btn next-lesson"
                           href="{{ route('courses.show', ['course' => $test->lesson->course_id]) }}">
                            Курстар тізіміне оралу
                        </a>
{{--                    @endif--}}
                </div>
            </div>
        </div>
    </section>
@endsection
