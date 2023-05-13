<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonTask extends Model
{
    use HasFactory;


    // lesson-tasks/12/123456789.docx
    const FILES_PATH = 'lesson-tasks';
    const SUCCESS_RESULT = 'success';
    const FAILED_RESULT = 'failed';


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLessonBy($query, $lessonId)
    {
        return $query->where('lesson_id', $lessonId);
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
