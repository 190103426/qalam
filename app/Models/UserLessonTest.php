<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLessonTest extends Model
{
    use HasFactory;

    const TEST_TIMER_LIMIT = 3600;

    public function userAnswers()
    {
        return $this->hasMany(UserLessonTestAnswer::class, 'test_uuid', 'uuid');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }

    public function scopeIsFinished($query)
    {
        return $query->where('is_finished', 1);
    }

    public function scopeLessonBy($query, $lessonId)
    {
        return $query->where('lesson_id', $lessonId);
    }

    protected $casts = [
        'is_finished' => 'boolean',
    ];
}
