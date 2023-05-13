@extends('layouts/app')
@section('content')
    <section class="info">
        <div class="container">
            <div class="teacher">
                <div class="name">
                    Qalam academy
                </div>
                <div class="work">
                    <img src="{{ asset('images/shield-tick.svg') }}" alt="">
                    <div class="wor1">Барлық сабақтардың бейнежазбасы қазақ тілінде беріледі</div>
                </div>
                <div class="work">
                    <img src="{{ asset('images/shield-tick.svg') }}" alt="">
                    <div class="wor1">Кез келген уақытта, қажет кезде көре аласыз.</div>
                </div>
                <div class="work">
                    <img src="{{ asset('images/shield-tick.svg') }}" alt="">
                    <div class="wor1">Курс әйелдер мен балаларға арналған</div>
                </div>
            </div>
            @guest
                <div class="fxw">
                    <button class="default-btn btn-md btn-tirke" onclick="openRegisterLink(this)">
                        <img src="{{ asset('images/user-add.svg') }}" alt="">
                        Платформаға Тіркелу
                    </button>
                    <button class="default-btn btn-md btn-kiru" onclick="openLogin(this)">
                        <img src="{{ asset('images/loginicon.svg') }}" alt="">
                        Платформаға Кіру
                    </button>
                </div>
            @endguest
        </div>
    </section>

    <section class="courses main-page top100">
        <div class="container">
            <div class="section-title">
                Біздің курстар
            </div>
            <div class="course-items">
                @forelse($courses as $course)
                    <div class="course-card">
                        <img class="course-card-img" width="100%" height="auto" src="{{asset($course->image
                                    ? (\App\Models\Course::IMAGE_PATH . $course->image)
                                    : 'images/course_1.png')}}"
                             alt="{{$course->name }}">
                        <div class="course-card-body">
                            @if($course->author)
                                <div class="author">
                                    Авторы: {{ $course->author }}
                                </div>
                            @endif
                            <h3 class="title">{{$course->name }}</h3>

                            @if($course->price || $course->old_price)
                                <div class="price">
                                    {{ \App\Services\NumberFormatService::money($course->price)  }} ₸
                                    @if($course->old_price)
                                        <span class="old-price">
                                {{ \App\Services\NumberFormatService::money($course->old_price)  }} ₸
                                    </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <a class="default-btn btn-open" href="{{ route('courses.show', $course) }}">
                            Толығырақ
                        </a>
                    </div>
                @empty
                    <h2>Курстар жақында салынады</h2>
                @endforelse
            </div>
        </div>
    </section>

    <section class="questions top100">
        <div class="container">
            <div class="section-title">
                Сұрақтарыңыз қалды ма?
            </div>
            <div class="questions-block">
                @foreach($questions as $question)
                    <div class="accordion-block">
                        <div class="accordion ">
                            {!! $question->text !!}
                            <div class="svg-block">
                                <svg class="icon arrow-down-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.9201 8.95001L13.4001 15.47C12.6301 16.24 11.3701 16.24 10.6001 15.47L4.08008 8.95001" stroke="#89808D" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                        </div>
                        <div class="panel">
                            <div class="answer">
                                {!! $question->answer !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
