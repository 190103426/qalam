<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessLesson extends Model
{
    use HasFactory;

    public function scopeIsWatched($query)
    {
        return $query->where('is_watched', true);

    }

    public function scopeUserBy($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    protected $fillable = [
        'user_id', 'lesson_id', 'course_id', 'module_id'
    ];
    protected $casts = [
        'is_watched' => 'boolean'
    ];
}
