<?php

namespace App\Models;

class Assignment extends Model
{
    protected $table = 'assignments';
    protected $guarded = ['assignment_id'];
    protected $primaryKey = 'assignment_id';


    public function courses()
    {
        return $this->BelongsTo(Course::class, 'course_id');
    }
}
