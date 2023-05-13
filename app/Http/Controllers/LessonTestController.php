<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonQuestion;
use App\Models\UserLessonTest;
use App\Models\UserLessonTestAnswer;
use App\Services\AccessLessonService;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonTestController extends Controller
{

    public function index($courseId, $lessonId)
    {

        $course = Course::has('accessCourseThisUser')->with('accessCourseThisUser')->findOrFail($courseId);
        if (empty($course->accessCourseThisUser) || (isset($course->accessCourseThisUser->to_date) && $course->accessCourseThisUser->to_date < now())) {
            return redirect()->route('courses.show', ['course' => $courseId]);
        }
//        $course = Course::accessCourseThisUser()->findOrFail($id);
//        if (empty($course->accessCourses) || (isset($course->accessCourses->to_date) && $course->accessCourses->to_date < now())) {
//            return redirect()->route('courses.index');
//        }
//        if (CourseService::isNotAccessThisUser($courseId)) {
//            return redirect()->route('courses.show', ['course' => $courseId]);
//        }
        $lesson = Lesson::with(['module.course' , 'thisUserTests' => fn($query)=> $query->withCount('userAnswers')])
            ->withCount('questions')
            ->findOrFail($lessonId);

        if (!$lesson->is_test_enabled) {
            return redirect()->route('courses.modules.lessons.show',['course' => $courseId,'module' => $lesson->module_id, 'lesson' => $lesson->id]);
        }
        return view('client.courses.lessons.test.index', compact('lesson'));
    }




    public function show($courseId, $lessonId, $testUUID)
    {

//        $course = Course::accessCourseThisUser()->findOrFail($id);
//        if (empty($course->accessCourses) || (isset($course->accessCourses->to_date) && $course->accessCourses->to_date < now())) {
//            return redirect()->route('courses.index');
//        }
//
//        $test = UserLessonTest::with([
//            'userAnswers' => fn($query) => $query->with('question'), 'course'
//        ])
//            ->where('uuid', $testUUID)
//            ->firstOrFail();
//
//        if ($test->is_finished) {
//            return redirect()->route('lessons.test.index', ['id' => $id, 'uuid' => $test->uuid]);
//        }
        $course = Course::has('accessCourseThisUser')->findOrFail($courseId);
        if (empty($course->accessCourseThisUser) || (isset($course->accessCourseThisUser->to_date) && $course->accessCourseThisUser->to_date < now())) {
            return redirect()->route('courses.show', ['course' => $courseId]);
        }
//        if (CourseService::isNotAccessThisUser($courseId)) {
//            return redirect()->route('courses.show', ['course' => $courseId]);
//        }
        $test = UserLessonTest::with([
            'userAnswers' => fn($query) => $query->with('question'),
            'lesson.module.course'
        ])
            ->whereHas('lesson.module.course', fn($query) => $query->whereId($courseId))
            ->whereHas('lesson', fn($query) => $query->whereId($lessonId))
//            ->lessonBy($lessonId)
            ->where('uuid', $testUUID)
            ->first();

        if ($test->is_finished) {
            return redirect()->route('lessons.test.result', ['course' => $courseId, 'lesson' => $lessonId, 'uuid' => $test->uuid]);
        }
        return view('client.courses.lessons.test.show', compact('test'));
    }


    public function store($courseId, $lessonId)
    {
        $course = Course::has('accessCourseThisUser')->findOrFail($courseId);
        if (empty($course->accessCourseThisUser) || (isset($course->accessCourseThisUser->to_date) && $course->accessCourseThisUser->to_date < now())) {
            return redirect()->route('courses.show', ['course' => $courseId]);
        }
//        if (CourseService::isNotAccessThisUser($courseId)) {
//            return redirect()->route('courses.show', ['course' => $courseId]);
//        }
        $lesson = Lesson::with(['module'])
            ->findOrFail($lessonId);
//        $test = UserLessonTest::isFinished()->latest()->first();
//        if ($test) {
//            return redirect()->route('lessons.test.show', ['course' => $courseId, 'lesson' => $lesson->id, 'uuid' => $test->uuid]);
//        }
        $test = $this->createTest($lesson);
        return redirect()->route('lessons.test.show', [
            'course' => $lesson->module->course_id,
            'lesson' => $lesson->id, 'uuid' => $test->uuid
        ]);
    }

    public function finish($courseId, $lessonId, $uuid, Request $request)
    {
        $test = UserLessonTest::with('userAnswers.question', 'lesson')
            ->where('uuid', $uuid)
            ->lessonBy($lessonId)
            ->firstOrFail();

        if ($test->is_finished) {
            return response()->json(['data' => [
                'success' => false,
                'route_result' => route('lessons.test.result', ['course' => $courseId, 'lesson' => $test->lesson->id, 'uuid' => $test->uuid])
            ]]);
        }

        DB::beginTransaction();
        foreach ($test->userAnswers as $userAnswer) {
            foreach ($request->user_answers as $requestUserAnswer) {
                if ($requestUserAnswer['question_id'] == $userAnswer->question_id) {
                    $userAnswer->answer_number = $requestUserAnswer['answer_number'];
                }
            }
        }
        $test->push();
        $test->load('userAnswers.question');
        $result = $this->getScoreAndAnswersCount($test);
        $test->is_finished = true;
        $test->score = $result['score'];
        $test->correct_answers_count = $result['correctAnswerCount'];
        $test->incorrect_answers_count = $result['incorrectAnswerCount'];
        $test->end_date = now();
        $test->save();

        $user = $request->user();
        if ($test->score >= $test->lesson->passing_test_percent  && $test->lesson->tasks()
                ->where('user_id', $user->id)
                ->where('result', 'success')
                ->exists()) {
            AccessLessonService::openAccessUser((int) $courseId,(int) $lessonId, auth()->user());
        }
        DB::commit();
        return response()->json(['data' => ['success' => true]]);
    }

    public function result($courseId, $lessonId, $uuid)
    {
        $test = UserLessonTest::with(['lesson.module.course'])
            ->withCount('userAnswers')

            ->whereHas('lesson.module.course', fn($query) => $query->whereId($courseId))
            ->whereHas('lesson', fn($query) => $query->whereId($lessonId))
            ->where('uuid', $uuid)
            ->isFinished()
            ->firstOrFail();
        return view('client.courses.lessons.test.result', compact('test'));
    }

    public function workMistake($courseId, $lessonId, $uuid)
    {
        $test = UserLessonTest::with([
            'userAnswers' => fn($query) => $query->with('question'),
            'lesson.module.course'])

            ->whereHas('lesson.module.course', fn($query) => $query->whereId($courseId))
            ->whereHas('lesson', fn($query) => $query->whereId($lessonId))
            ->withCount('userAnswers')
            ->where('uuid', $uuid)
            ->isFinished()
            ->firstOrFail();
        return view('client.courses.lessons.test.work-mistake', compact('test'));
    }

    protected function createTest($lesson)
    {
        $user = auth()->user();
        DB::beginTransaction();
        $test = new UserLessonTest();
        $test->uuid = $user->id . time() . 'i';
        $test->user_id = $user->id;
        $test->lesson_id = $lesson->id;
        $test->time = UserLessonTest::TEST_TIMER_LIMIT;
        $test->save();

        $questions = LessonQuestion::orderByRaw('RAND()')
            ->lessonBy($lesson->id)
            ->limit(LessonQuestion::LIMIT_QUESTION)
            ->get();

        $userAnswers = [];
        foreach ($questions as $question) {
            $userAnswers[] = [
                'test_uuid' => $test->uuid,
                'question_id' => $question->id,
            ];
        }
        UserLessonTestAnswer::insert($userAnswers);
        DB::commit();
        return $test;

    }

    protected function getScoreAndAnswersCount($test)
    {
        $correctAnswerCount = 0;
        $incorrectAnswerCount = 0;
        foreach ($test->userAnswers as $userAnswer) {
            if ($userAnswer->question->current_answer_number) {
                if ($userAnswer->answer_number == $userAnswer->question->current_answer_number) {
                    $correctAnswerCount++;
                } else {
                    $incorrectAnswerCount++;
                }
            } else {
                $incorrectAnswerCount++;
            }
        }
        $score = floor( ($correctAnswerCount * 100) / count($test->userAnswers));
        return compact('score', 'correctAnswerCount', 'incorrectAnswerCount');
    }
}
