@extends('layouts/app')
@section('content')

    @component('client.components.breadcrumb')
        @slot('title') Сұрақ-жауап@endslot
        @slot('parent') Басты бет @endslot
        @slot('active') Сұрақ-жауап @endslot
    @endcomponent
    <section class="questions">
        <div class="container">
            <div class="questions-block">

                @foreach($questions as $question)
                <div class="accordion-block questions-accordion">
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
