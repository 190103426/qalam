<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessCourse extends Model
{
    use HasFactory;

    protected $casts = [
        'to_date' => 'datetime:Y-m-d H:i',
        'created_at' => 'datetime:Y-m-d H:i'
    ];
}
