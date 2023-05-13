<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    const FILES_PATH = 'uploads/files/course-';
    const DEFAULT_TEST_DURATION = 60;

    /**
     * @var array
     */
    protected $guarded = [];

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function module(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function questions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LessonQuestion::class, 'lesson_id', 'id');
    }

    public function thisUserTests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserLessonTest::class, 'lesson_id', 'id')
            ->where('user_id', auth()->user()->id)->orderByDesc('id');
    }
    public function tests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserLessonTest::class, 'lesson_id', 'id')
            ->orderByDesc('id');
    }

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LessonTask::class, 'lesson_id', 'id');
    }

    public function task()
    {
        return $this->hasOne(LessonTask::class, 'lesson_id', 'id');
    }

    public function tasksThisUser()
    {
        return $this->hasMany(LessonTask::class, 'lesson_id', 'id')->where('user_id', auth()->user()->id);
    }

    public function accessThisUser()
    {
        return $this->hasOne(UserAccessLesson::class, 'lesson_id', 'id')
            ->where('user_id', (auth()->user()->id) ?? '');
    }


    public function accessLesson()
    {
        return $this->hasOne(UserAccessLesson::class, 'lesson_id', 'id');
    }
    public function accessLessons()
    {
        return $this->hasMany(UserAccessLesson::class, 'lesson_id', 'id');
    }
//
//    public function accessUsers()
//    {
//        return $this->hasMany(UserAccessLesson::class, 'lesson_id', 'id');
//    }


    /**
     * @param $query
     * @param $moduleId
     * @return mixed
     */
    public function scopeModuleBy($query, $moduleId)
    {
        return $query->where('module_id', $moduleId);
    }

    public function scopeCourseBy($query, $courseBy)
    {
        return $query->where('course_id', $courseBy);
    }

    public function getShortDescriptionAttribute(): string
    {
        return mb_strimwidth($this->description, 0, 100, "...");
    }


    /**
     * @var string[]
     */
    protected $casts = [
        'videos' => 'boolean',
        'files' => 'boolean',
        'is_test_enabled' => 'boolean',
    ];
}
