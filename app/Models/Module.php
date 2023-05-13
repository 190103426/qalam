<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function accessLessonsUsers()
    {
        return $this->hasMany(UserAccessLesson::class, 'module_id', 'id');
    }

    public function scopeCourseBy($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    public function scopeJoinCourseName($query)
    {
        return $query->leftJoin('courses', 'courses.id', 'modules.course_id')
            ->selectRaw('modules.*, courses.name as course_name');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'module_id', 'id');
    }
}
