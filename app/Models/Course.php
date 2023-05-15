<?php

namespace App\Models;

class Course extends Model
{
    protected $table = 'courses';
    protected $guarded = ['course_id'];
    protected $primaryKey = 'course_id';

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    public function users()
    {
        return $this->BelongsTo(User::class, 'instructor_id');
    }
}
