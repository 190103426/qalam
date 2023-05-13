<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function getShortAnswerAttribute()
    {
        return mb_strimwidth($this->answer, 0, 100, "...");
    }
}
