<?php

namespace App\Services;

use App\Models\Lesson;

class LessonService
{
    public static $checkboxTrueValues = ['yes', 'on', '1', 1, true, 'true'];
    public function handle($lesson, $module, $request)
    {
        $lesson->name = $request->name;
        $lesson->description = $request->description;
        $lesson->task = $request->task;
        $lesson->course_id = $module->course_id;
        $lesson->video_1 = $request->video_1;
        $lesson->video_2 = $request->video_2;
        $lesson->video_3 = $request->video_3;
        $lesson->test_duration = $request->test_duration ?: Lesson::DEFAULT_TEST_DURATION;
        $lesson->is_test_enabled = in_array($request->is_test_enabled, self::$checkboxTrueValues);
        $lesson->passing_test_percent = $request->input('passing_test_percent', 50);

        $path = Lesson::FILES_PATH . $module->course_id;
        if ($request->hasFile('file_1')) {
            $lesson->file_1 = FileService::saveFile($request->file('file_1'), $path, $lesson->file_1);
        }
        if ($request->hasFile('file_2')) {
            $lesson->file_2 = FileService::saveFile($request->file('file_2'), $path, $lesson->file_2);
        }
        if ($request->hasFile('file_3')) {
//            $lesson->file_3 = $this->saveFile($lesson, $request->file('file_3'), $module->course_id);
            $lesson->file_3 = FileService::saveFile($request->file('file_3'), $path, $lesson->file_3);
        }
        return $lesson;
    }

    public function save($lesson, $module, $request)
    {
        $lesson = $this->handle($lesson, $module, $request);
        $lesson->save();
        return $lesson;
    }
//    protected function isFileExistsChangeName($courseId, $file, $fileName)
//    {
//        if (File::exists( Lesson::FILES_PATH . $courseId ."/$fileName")) {
//            $fileName  =  $file->getClientOriginalName() ."_" . rand(1,99). '.' . $file->getClientOriginalExtension();
//        }
//        return $fileName;
//    }
}
