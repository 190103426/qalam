<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    const IMAGE_PATH = 'uploads/images/courses/';
    const LESSON_FILES_PATH = 'uploads/files/course-';

    protected $guarded = [];

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function lessons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function accessLessonsThisUser()
    {
        return $this->hasMany(UserAccessLesson::class, 'course_id', 'id')
            ->where('user_id', auth()->user()->id ?? 0);
    }
//
    public function accessCourseThisUser(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserAccessCourse::class, 'course_id', 'id')
            ->where('user_id', auth()->user()->id ?? 0);
    }

    public function accessCourses()
    {
        return $this->hasOne(UserAccessCourse::class, 'course_id', 'id');
    }

    public function modules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Module::class, 'course_id', 'id');
    }



    public function getShortDescriptionAttribute(): string
    {
        return mb_strimwidth($this->description, 0, 100, "...");
    }

}
