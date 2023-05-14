<?php

namespace App\Controllers;

use App\Models\Course;

class DosenController extends BaseController
{
    public function listCourse()
    {
        $data = [
            'data' => Course::where('instructor_id', session()->get('user')->user_id)->get()
        ];
        respons()->view('main.dosen.listcourse', $data);
    }

    public function listCourseDetail($id)
    {
        $data = [
            'data' => Course::where('course_id', $id)->with('enrollments', function ($query) {
                $query->with('users', function ($query) {
                    $query->select(['user_id', 'name', 'email']);
                });
            })->first(),
            'lesson' => Course::where('course_id', $id)->with('lessons', function ($query) {
                $query->select(['lesson_id', 'course_id', 'lesson_name', 'lesson_video', 'lesson_desc']);
            })->first()
        ];
        respons()->view('main.dosen.listcoursedetail', $data);
    }
}
