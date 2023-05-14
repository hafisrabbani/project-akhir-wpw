<?php

namespace App\Models;

class Submission extends Model
{
    protected $table = 'submissions';
    protected $guarded = ['submission_id'];
    protected $primaryKey = 'submission_id';

    public function assignments()
    {
        return $this->BelongsTo(Assignment::class, 'assignment_id');
    }

    public function users()
    {
        return $this->BelongsTo(User::class, 'user_id');
    }
}
