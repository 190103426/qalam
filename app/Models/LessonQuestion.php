<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonQuestion extends Model
{
    use HasFactory;

    const LIMIT_QUESTION = 30;

    public function userAnswers()
    {
        return $this->hasMany(UserLessonTestAnswer::class, 'question_id', 'id');
    }

    public function scopeLessonBy($query, $lessonId)
    {
        return $query->where('lesson_id', $lessonId);
    }
}
