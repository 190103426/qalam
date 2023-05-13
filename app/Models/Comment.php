<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function reply()
    {
        return $this->hasOne(Comment::class, 'parent_id');
    }

    public function scopeJoinUserFullName($query)
    {
        $query->leftJoin('users', 'users.id', 'comments.user_id')
            ->selectRaw('comments.*, users.full_name as full_name');
        return $query;
    }


    protected $casts = [
        'created_at' => 'datetime:d.m.Y'
    ];
}
