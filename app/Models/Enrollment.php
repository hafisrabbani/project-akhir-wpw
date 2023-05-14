<?php

namespace App\Models;

class Enrollment extends Model
{
    protected $table = 'enrollments';
    protected $guarded = ['enrollment_id'];
    protected $primaryKey = 'enrollment_id';

    public function users()
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function courses()
    {
        return $this->BelongsTo(Course::class, 'course_id');
    }
}
