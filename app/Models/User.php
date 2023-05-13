<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const IMAGE_PATH = 'uploads/images/users/';

    public function accessCourses(){
        return $this->hasMany(UserAccessCourse::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'password',
    ];

    protected $guarded = [
        'is_admin'
    ];

    protected $hidden = [
        'password',
    ];


    protected $casts = [
        'is_admin' => 'boolean',
    ];
}
