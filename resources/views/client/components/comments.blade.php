@forelse($comments as $comment)
    <div class="comment-item">
        <img src="{{asset('images/comment-user-icon.png')}}" alt="user icon">
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
                    <div class="answer answer-comment-reply-{{$comment->id}}" onclick="openCommentReplyForm({{$comment->id}})">
                        <svg width="14" height="12" viewBox="0 0 14 12" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.56238 3.37507H5.24986V1.18753C5.24986 1.00641 5.13874 0.844529 4.97073 0.778903C4.80273 0.714152 4.6111 0.759652 4.4886 0.893529L0.113533 5.7061C-0.0378443 5.87236 -0.0378443 6.12699 0.113533 6.29411L4.4886 11.1067C4.57348 11.1994 4.6916 11.2502 4.81236 11.2502C4.86573 11.2502 4.91911 11.2406 4.97073 11.2213C5.13874 11.1557 5.24986 10.9938 5.24986 10.8127V8.62515H6.46701C8.9643 8.62515 11.3828 9.51941 13.2781 11.1452C13.4067 11.2563 13.5914 11.2817 13.7454 11.2099C13.9011 11.1391 14 10.9833 14 10.8127C14 6.71149 10.6636 3.37507 6.56238 3.37507ZM6.46701 7.75014H4.81236C4.57085 7.75014 4.37485 7.94614 4.37485 8.18764V9.68129L1.0288 6.00011L4.37485 2.31893V3.81257C4.37485 4.05408 4.57085 4.25008 4.81236 4.25008H6.56238C8.31504 4.25008 9.96356 4.93259 11.2026 6.17161C12.215 7.184 12.8564 8.4694 13.0567 9.86067C11.1405 8.4939 8.83654 7.75014 6.46701 7.75014Z"
                                fill="#C6711A"/>
                        </svg>
                        Жауап жазу
                    </div>
                </div>
                <div class="comment-replies">
                    <form action="{{route('lessons.commentSave', $lesson_id)}}" method="post"
                          class="w-100">

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
                </div>
            </div>
        </div>
    </div>
@empty
    <h4>Пікірлер табылмады</h4>
@endforelse
