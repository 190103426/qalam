<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLessonTestAnswer extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(LessonQuestion::class, 'question_id', 'id');
    }
}
