<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\UserAccessLesson;
use Illuminate\Support\Facades\DB;

class AccessLessonService
{
    public static function openAccessUser(int $courseId, int $lessonId, $user)
    {
        $lesson = Lesson::with(['course.lessons', 'module.lessons',
            'accessLesson' => fn($query) => $query->where('user_id', $user->id)
        ])
            ->courseBy($courseId)
            ->withCount('questions')
            ->findOrFail($lessonId);


        if ($lesson->is_test_enabled) {
            $passingAnswerCount = (int) self::getPassingBall( $lesson->questions_count, $lesson->passing_test_percent );
            $isTestPassed = $lesson->tests()
                ->where('user_id', $user->id)
                ->where('correct_answers_count','>=', $passingAnswerCount)
            ->exists();
            if (!$isTestPassed) {
                return false;
            }
        }
        if ($lesson->course->lessons->last()->id == $lessonId) {
            return redirect()->route('courses.show', ['course' => $courseId]);
        }

        $nextLesson = self::getNextLesson($lesson, $lessonId);
        DB::beginTransaction();
        UserAccessLesson::firstOrCreate([
            'user_id' => $user->id,
            'lesson_id' => $nextLesson->id,
            'module_id' => $nextLesson->module_id,
            'course_id' => $courseId,
        ]);
        DB::commit();
        return $courseId;
    }

    private static function getNextLesson($lesson, $lessonId)
    {
        $lessonsIds = $lesson->module->lessons->pluck('id')->toArray();

        for ($i = 0; $i < count($lessonsIds); $i++) {
            if ($lessonsIds[$i] === $lessonId) {
                $nextModuleLessonId = ($lessonsIds[$i + 1]) ?? 'end';
            }
        }
        if ($nextModuleLessonId !== 'end') {
            $nextLesson = $lesson->course->lessons->find($nextModuleLessonId);
        } else {
            $nextLesson = self::getFirstLessonLastModule($lesson, $lesson->module_id);
        }
        return $nextLesson;
    }

    private static function getFirstLessonLastModule($lesson, $moduleId)
    {
        $courseModulesIds = $lesson->course->modules->pluck('id')->toArray();
        for ($i = 0; $i < count($courseModulesIds); $i++) {
            if ($courseModulesIds[$i] === $moduleId) {
                $newModuleId = (int)$courseModulesIds[$i + 1];
            }
        }
        $nextLesson = $lesson->course->lessons->where('module_id', $newModuleId)->first();
        if (empty($nextLesson)) {
            self::getFirstLessonLastModule($lesson, $newModuleId);
        }
        return $nextLesson;
    }

    private static function getPassingBall($questionsCount, $percent)
    {
        return round($questionsCount * $percent / 100);
    }

}
