<?php

namespace App\Models;

class Lesson extends Model
{
    protected $table = 'lessons';
    protected $guarded = ['lesson_id'];
    protected $primaryKey = 'lesson_id';

    public function courses()
    {
        return $this->BelongsTo(Course::class, 'course_id');
    }
}
