@extends('layouts/app')
<link>
@section('content')
    @component('client.components.breadcrumb')
        @slot('title') {{$course->name}}@endslot
        @slot('parent') Басты бет @endslot
        @slot('courses') Курстар тізімі @endslot
        @slot('active') {{$course->name}} @endslot
    @endcomponent
    <section class="course">
        <div class="container">
            <div class="course-info">
                @if($course->intro_video)
                    <div class="plyr__video-embed lesson-video" id="lesson-video-plyr">
                        {!! $course->intro_video !!}
                    </div>
                @endif

                @if($course->description)
                <div class="description-title">
                    Курс туралы
                </div>
                <div class="description">

                    {!! $course->description !!}
                </div>
                        <div class="hr"></div>
                    @endif
                <div class="md-title">
                    Сабақтар
                </div>
                <div class="lesson-items">
                    @forelse($course->modules as $keyModule => $module)
                        <div class="accordion-block">
                            <div class="accordion-header">
                                <div class="module">
                                        {{ $keyModule + 1 }} - Модуль.
                                        {{ $module->name }}
                                </div>
{{--                                <svg class="icon arrow-down-red-icon">--}}
{{--                                    <use xlink:href="{{ asset('images/arrow-down-module.svg#arrow-down-module') }}"></use>--}}
{{--                                </svg>--}}

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.92 8.94995L13.4 15.47C12.63 16.24 11.37 16.24 10.6 15.47L4.08 8.94995" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                            <div class="accordion-panel">
                                <div>
                                    @forelse($module->lessons as $keyLesson => $lesson)
                                        @if($course->access_course_this_user_exists && $lesson->access_this_user_exists)
                                            <a class="module-link"
                                               href="{{ route('courses.modules.lessons.show', ['course' => $course->id, 'lesson' => $lesson->id,'module' => $module->id]) }}">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="#11A50E"/>
                                                    <path d="M14.9701 10.23L12.0701 8.56C11.3501 8.14 10.4801 8.14 9.76011 8.56C9.04011 8.98 8.61011 9.72 8.61011 10.56V13.91C8.61011 14.74 9.04011 15.49 9.76011 15.91C10.1201 16.12 10.5201 16.22 10.9101 16.22C11.3101 16.22 11.7001 16.12 12.0601 15.91L14.9601 14.24C15.6801 13.82 16.1101 13.08 16.1101 12.24C16.1301 11.4 15.7001 10.65 14.9701 10.23Z" fill="white"/>
                                                </svg>
                                                <div class="title">

                                                    {{ $lesson->name }}


                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.4302 5.93005L20.5002 12.0001L14.4302 18.0701" stroke="#0E7D0B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M3.5 12H20.33" stroke="#0E7D0B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </div>

                                            </a>
                                        @else
                                            <a class="module-link block"
                                               href="javascript:void(0)">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M17.5227 7.39601V8.92935C19.2451 9.46696 20.5 11.0261 20.5 12.8884V17.8253C20.5 20.1308 18.5886 22 16.2322 22H7.7688C5.41136 22 3.5 20.1308 3.5 17.8253V12.8884C3.5 11.0261 4.75595 9.46696 6.47729 8.92935V7.39601C6.48745 4.41479 8.95667 2 11.9848 2C15.0535 2 17.5227 4.41479 17.5227 7.39601ZM12.0051 3.73904C14.0678 3.73904 15.7445 5.37871 15.7445 7.39601V8.7137H8.25553V7.37613C8.26569 5.36878 9.94232 3.73904 12.0051 3.73904ZM12.8891 16.4549C12.8891 16.9419 12.4928 17.3294 11.9949 17.3294C11.5072 17.3294 11.1109 16.9419 11.1109 16.4549V14.2488C11.1109 13.7718 11.5072 13.3843 11.9949 13.3843C12.4928 13.3843 12.8891 13.7718 12.8891 14.2488V16.4549Z"
                                                          fill="#959595"/>
                                                </svg>

                                               {{ $lesson->name }}

                                            </a>
                                        @endif
                                    @empty
                                        <a class="module-link block"
                                           href="javascript:void(0)">
                                            Сабақтар бос

                                        </a>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    @empty
                        <h4>Модульдер бос</h4>
                    @endforelse
                </div>

            </div>
        </div>
    </section>
@endsection
