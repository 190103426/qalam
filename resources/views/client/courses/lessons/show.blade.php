@extends('layouts/app')
<link>
@section('content')

    @component('client.components.breadcrumb')
        @slot('title')
            {{$lesson->name}}
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
        @slot('module')
            {{$lesson->module->name}}
        @endslot
        @slot('active')
            {{$lesson->name }}
        @endslot
    @endcomponent
    <section class="course">
        <div class="container">
            <div class="course-info">
                @if($lesson->video_1)
                    <div class="plyr__video-embed lesson-video" id="lesson-video-plyr">
                        {!! $lesson->video_1 !!}
                    </div>
                @endif
                @if($lesson->video_2)
                    <div class="plyr__video-embed lesson-video " id="lesson-video-plyr">
                        {!! $lesson->video_2 !!}

                    </div>
                @endif
                @if($lesson->video_3)
                    <div class="plyr__video-embed lesson-video-plyr" id="lesson-video-plyr">
                        {!! $lesson->video_3 !!}
                    </div>
                @endif
                @if($lesson->description)
                    <div class="description">
                        {!! $lesson->description !!}
                    </div>
                @endif

                <div class="lesson-document-items">
                    @if($lesson->file_1)
                        <div class="lesson-document-item">
                            <a href="{{route('downloadFile', ['file_name' => \App\Models\Lesson::FILES_PATH . $lesson->course_id ."/$lesson->file_1"])}}"
                               target="_blank">
                            <span class="left">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M14.7364 2.76196H8.08437C6.02537 2.76196 4.25037 4.43096 4.25037 6.49096V17.228C4.25037 19.404 5.90837 21.115 8.08437 21.115H16.0724C18.1324 21.115 19.8024 19.288 19.8024 17.228V8.03796L14.7364 2.76196Z"
      stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path
    d="M14.4736 2.75024V5.65924C14.4736 7.07924 15.6226 8.23124 17.0426 8.23424C18.3586 8.23724 19.7056 8.23824 19.7966 8.23224"
    stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.6406 16.0138V9.4408" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.80225 13.1632L11.6402 16.0142L14.4792 13.1632" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round"
      stroke-linejoin="round"/>
</svg>

                                                             {{$lesson->file_1}}
                            </span>
                                <span class="download">

                                Жүктеп алу
                                </span>
                            </a>
                        </div>
                    @endif
                    @if($lesson->file_2)
                        <div class="lesson-document-item">
                            <a href="{{route('downloadFile', ['file_name' => \App\Models\Lesson::FILES_PATH . $lesson->course_id ."/$lesson->file_2"])}}"
                               target="_blank">
                                <span class="left">
                                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M14.7364 2.76196H8.08437C6.02537 2.76196 4.25037 4.43096 4.25037 6.49096V17.228C4.25037 19.404 5.90837 21.115 8.08437 21.115H16.0724C18.1324 21.115 19.8024 19.288 19.8024 17.228V8.03796L14.7364 2.76196Z"
      stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path
    d="M14.4736 2.75024V5.65924C14.4736 7.07924 15.6226 8.23124 17.0426 8.23424C18.3586 8.23724 19.7056 8.23824 19.7966 8.23224"
    stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.6406 16.0138V9.4408" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.80225 13.1632L11.6402 16.0142L14.4792 13.1632" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round"
      stroke-linejoin="round"/>
</svg>

                                    {{$lesson->file_2}}
                                </span>
                                <span class="download">
    Жүктеп алу
                                </span>
                            </a>
                        </div>
                    @endif
                    @if($lesson->file_3)
                        <div class="lesson-document-item">
                            <a href="{{route('downloadFile', ['file_name' => \App\Models\Lesson::FILES_PATH . $lesson->course_id ."/$lesson->file_3"])}}"
                               target="_blank">
                                <span class="left">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M14.7364 2.76196H8.08437C6.02537 2.76196 4.25037 4.43096 4.25037 6.49096V17.228C4.25037 19.404 5.90837 21.115 8.08437 21.115H16.0724C18.1324 21.115 19.8024 19.288 19.8024 17.228V8.03796L14.7364 2.76196Z"
      stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path
    d="M14.4736 2.75024V5.65924C14.4736 7.07924 15.6226 8.23124 17.0426 8.23424C18.3586 8.23724 19.7056 8.23824 19.7966 8.23224"
    stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.6406 16.0138V9.4408" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.80225 13.1632L11.6402 16.0142L14.4792 13.1632" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round"
      stroke-linejoin="round"/>
</svg>

                                    {{$lesson->file_3}}
                            </span>
                                <span class="download">

                                Жүктеп алу
                                </span>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="task-body">
                    <div class="title">
                        Тапсырманы жіберу
                    </div>
                    @error('file_1')
                    <div class="info " id="task_input_text" style="color: rgb(152, 19, 35);">{{ $message }}</div>
                    @else
                        <div class="info " id="task_input_text">
                            @if(empty($task))
                                Файл жүктеу
                            @else
                                @if(empty($task->result))
                                    <div class="alert alert-warning" role="alert">

                                        Жауабыңыз тексеріс үстінде, күте тұруыңызды сұраймыз.
                                    </div>
                                @else

                                    @if($task->result == 'success')
                                        <div class="alert alert-success" role="alert">
                                            Тапрсыманы дұрыс орындадыңыз.
                                            {!!$task->comment_teacher ? '<br>' . 'Куратор пікірі:' . $task->comment_teacher : '' !!}

                                        </div>
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                            Тапрсыманы қате орындадыңыз.
                                            {!!$task->comment_teacher ? '<br>' . 'Куратор пікірі:' . $task->comment_teacher : '' !!}

                                        </div>
                                    @endif
                                @endif
                            @endif
                        </div>
                        @enderror

                        <form
                            action="{{ route('lessons.taskStore', ['course' => $lesson->module->course_id, 'lesson' => $lesson->id]) }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="form-task-block">
                            @method('POST')
                            @csrf
                            <div class="task">
                                <input type="file" hidden id="task" name="file_1"
                                       onchange="change_file_input(this,1,'task_input_text')">
                                <label class="title input-file " for="task">

                                    <svg width="35" height="35" viewBox="0 0 35 35" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M27.5916 5.86056H9.53866C8.97941 5.86056 8.52605 5.4072 8.52605 4.84795V4.34127C8.52605 3.77108 8.06381 3.30884 7.49362 3.30884H2.06486C0.924492 3.30884 0 4.23326 0 5.3737V22.7481L2.6494 9.85849C2.7462 9.38763 3.1606 9.04973 3.6413 9.04973H29.6565V7.92542C29.6565 6.78498 28.732 5.86056 27.5916 5.86056Z"
                                            fill="#668EF4"/>
                                        <path
                                            d="M32.9348 11.075H4.46688L0.482417 30.4594C0.351714 31.0954 0.837476 31.6912 1.48682 31.6912H31.1108C32.1634 31.6912 33.0475 30.8996 33.1632 29.8534L34.9872 13.3669C35.1224 12.144 34.1651 11.075 32.9348 11.075Z"
                                            fill="#B0C4F8"/>
                                    </svg>
                                    <p class="text">
                                        Өз файлыңызды осында салыңыз
                                    </p>
                                </label>
                                <button class="sent-task-btn" type="submit">
                                    Жіберу
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                              d="M7.1099 5.96003L16.1299 2.95003C20.1799 1.60003 22.3799 3.81003 21.0399 7.86003L18.0299 16.88C16.0099 22.95 12.6899 22.95 10.6699 16.88L9.7799 14.2L7.0999 13.31C1.0399 11.3 1.0399 7.99003 7.1099 5.96003Z"
                                              fill="white"/>
                                        <path d="M12.1201 11.6301L15.9301 7.81006L12.1201 11.6301Z" fill="white"/>
                                        <path
                                            d="M12.1201 12.38C11.9301 12.38 11.7401 12.31 11.5901 12.16C11.3001 11.87 11.3001 11.39 11.5901 11.1L15.3901 7.28C15.6801 6.99 16.1601 6.99 16.4501 7.28C16.7401 7.57 16.7401 8.05 16.4501 8.34L12.6501 12.16C12.5001 12.3 12.3101 12.38 12.1201 12.38Z"
                                            fill="white"/>
                                    </svg>
                                </button>
                            </div>
                        </form>

                </div>
                @if($lesson->is_test_enabled)
                    <a class="default-btn submit-btn"
                       href="{{ route('lessons.test.index', ['course' => $lesson->module->course_id, 'lesson' => $lesson->id]) }}">
                        Тест тапсыру
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.79 4.21995C16.83 1.26995 12.03 1.26995 9.09002 4.21995C7.02002 6.26995 6.40002 9.21995 7.20002 11.8199L2.50002 16.5199C2.17002 16.8599 1.94002 17.5299 2.01002 18.0099L2.31002 20.1899C2.42002 20.9099 3.09002 21.5899 3.81002 21.6899L5.99002 21.9899C6.47002 22.0599 7.14002 21.8399 7.48002 21.4899L8.30002 20.6699C8.50002 20.4799 8.50002 20.1599 8.30002 19.9599L6.36002 18.0199C6.07002 17.7299 6.07002 17.2499 6.36002 16.9599C6.65002 16.6699 7.13002 16.6699 7.42002 16.9599L9.37002 18.9099C9.56002 19.0999 9.88002 19.0999 10.07 18.9099L12.19 16.7999C14.78 17.6099 17.73 16.9799 19.79 14.9299C22.74 11.9799 22.74 7.16995 19.79 4.21995ZM14.5 11.9999C13.12 11.9999 12 10.8799 12 9.49995C12 8.11995 13.12 6.99995 14.5 6.99995C15.88 6.99995 17 8.11995 17 9.49995C17 10.8799 15.88 11.9999 14.5 11.9999Z"
                                fill="white"/>
                        </svg>
                    </a>
                @endif
            </div>
            <div class="lesson-comments">
                <div class="comment-enter">
                    <div class="title">
                        Өз пікіріңізді қалдырыңыз
                    </div>
                    @error('text')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <div class="comment-enter-body">
                        {{--                        <img src="{{asset('images/comment-user-icon.png')}}" alt="user icon" width="30" height="30">--}}
                        <img
                            src="{{asset(auth()->user()->image ? \App\Models\User::IMAGE_PATH .'/'.auth()->user()->image: 'images/comment-user-icon.png')}}"
                            alt="user icon" width="30" height="30" style="border-radius: 50%">

                        @auth
                            <form action="{{route('lessons.commentSave', $lesson->id)}}" method="post" class="w-100">

                                @csrf
                                @method('POST')
                                <div class="comment-input">
                                    <textarea class="form-control default-textarea" rows="8" name="text" required
                                              placeholder="Пікіріңізді осында жазыңыз"></textarea>

                                    <button class="btn dark-bright-btn btn-send-comment"
                                            type="submit"
                                    >
                                        Пікір қалдыру
                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.3554 6.12111L8.6916 11.8227L2.06064 7.74147C1.19176 7.20657 1.36787 5.88697 2.3467 5.60287L18.0022 1.04743C18.8925 0.789782 19.7156 1.62446 19.449 2.51889L14.804 18.1582C14.513 19.1369 13.2082 19.3064 12.6809 18.4325L8.6916 11.8227"
                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="comment-input">
                            <textarea class="form-control text" name="text"
                                      required
                            >
                            </textarea>
                                <button class="btn dark-bright-btn btn-send-comment"
                                        onclick="openRegisterLink(this)"
                                >
                                    Пікір қалдыру
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.3554 6.12111L8.6916 11.8227L2.06064 7.74147C1.19176 7.20657 1.36787 5.88697 2.3467 5.60287L18.0022 1.04743C18.8925 0.789782 19.7156 1.62446 19.449 2.51889L14.804 18.1582C14.513 19.1369 13.2082 19.3064 12.6809 18.4325L8.6916 11.8227"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="line"></div>
                <div class="comment-items">
                    <div class="title">
                        {{$lesson->comments_count ? "Пікірлер ($lesson->comments_count)" : 'Пікірлер  табылмады'}}
                    </div>
                    @foreach($lesson->comments as $comment)
                        <div class="comment-item">
                            <img
                                src="{{asset($comment->user->image ? \App\Models\User::IMAGE_PATH .'/'. $comment->user->image: 'images/comment-user-icon.png')}}"
                                alt="user icon">
                            <div class="comment-body">
                                <div class="comment-user">
                                    {{ $comment->user->full_name }}
                                </div>
                                <div class="comment-text">
                                    {{ $comment->text }}
                                </div>
                                <div class="comment-date-and-answer">
                                    <div class="comment-date-answer">
                                        @if($comment->created_at)
                                            <div class="comment-date">
                                                {{$comment->created_at->format('d.m.Y')}}
                                            </div>
                                        @endif
                                        @if(!$comment->reply)
                                            <div
                                                class="answer answer-comment-replY answer-comment-reply-{{$comment->id}}"
                                                onclick="openCommentReplyForm({{$comment->id}})">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4"
                                                          d="M16.19 2H7.82C4.17 2 2 4.17 2 7.81V16.18C2 19.82 4.17 21.99 7.81 21.99H16.18C19.82 21.99 21.99 19.82 21.99 16.18V7.81C22 4.17 19.83 2 16.19 2Z"
                                                          fill="#89808D"/>
                                                    <path
                                                        d="M13.9199 8.48006H8.76994L9.09994 8.15006C9.38994 7.86006 9.38994 7.38006 9.09994 7.09006C8.80994 6.80006 8.32994 6.80006 8.03994 7.09006L6.46994 8.66006C6.17994 8.95006 6.17994 9.43006 6.46994 9.72006L8.03994 11.2901C8.18994 11.4401 8.37994 11.5101 8.56994 11.5101C8.75994 11.5101 8.94994 11.4401 9.09994 11.2901C9.38994 11.0001 9.38994 10.5201 9.09994 10.2301L8.83994 9.97006H13.9199C15.1999 9.97006 16.2499 11.0101 16.2499 12.3001C16.2499 13.5901 15.2099 14.6301 13.9199 14.6301H8.99994C8.58994 14.6301 8.24994 14.9701 8.24994 15.3801C8.24994 15.7901 8.58994 16.1301 8.99994 16.1301H13.9199C16.0299 16.1301 17.7499 14.4101 17.7499 12.3001C17.7499 10.1901 16.0299 8.48006 13.9199 8.48006Z"
                                                        fill="#89808D"/>
                                                </svg>

                                                Жауап жазу
                                            </div>
                                        @endif
                                    </div>
                                    <div class="comment-replies">
                                        @if($comment->reply)
                                            <div class="comment-item">
                                                {{--                                                <img src="{{asset('images/comment-user-icon.png')}}" alt="user icon">--}}
                                                <img
                                                    src="{{asset($comment->user->image ? \App\Models\User::IMAGE_PATH .'/'. $comment->user->image: 'images/comment-user-icon.png')}}"
                                                    alt="user icon">
                                                <div class="comment-body">
                                                    <div class="comment-user">
                                                        {{ $comment->reply->user->full_name }}
                                                    </div>
                                                    <div class="comment-text">
                                                        {{ $comment->reply->text }}
                                                    </div>
                                                    <div class="comment-date-and-answer">
                                                        <div class="comment-date-answer">
                                                            @if($comment->reply->created_at)
                                                                <div class="comment-date">
                                                                    {{$comment->reply->created_at->format('d.m.Y')}}
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <form action="{{route('lessons.commentSave', $lesson->id)}}" method="post"
                                                  class="w-100 comment-reply comment-reply-{{$comment->id}}">

                                                @csrf
                                                @method('POST')
                                                <input type="hidden" value="{{$comment->id}}" name="comment_id">
                                                <div class="comment-input">
                                                <textarea class="form-control default-textarea" rows="8" name="text"
                                                          required placeholder="Пікіріңізді осында жазыңыз"></textarea>

                                                    <button class="btn dark-bright-btn btn-send-comment"
                                                            type="submit"
                                                    >
                                                        Пікір қалдыру
                                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M14.3554 6.12111L8.6916 11.8227L2.06064 7.74147C1.19176 7.20657 1.36787 5.88697 2.3467 5.60287L18.0022 1.04743C18.8925 0.789782 19.7156 1.62446 19.449 2.51889L14.804 18.1582C14.513 19.1369 13.2082 19.3064 12.6809 18.4325L8.6916 11.8227"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endsection
