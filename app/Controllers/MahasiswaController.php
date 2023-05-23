<?php

namespace App\Controllers;

use App\Models\Enrollment;
use App\Models\Lesson;

class MahasiswaController extends BaseController
{
    public function lessonIndex()
    {
    }

    public function listCourse()
    {
        $data = [
            'data' => Enrollment::where('user_id', session()->get('user')->user_id)->get()
        ];
        respons()->view('main.mahasiswa.course', $data);
    }

    public function listLesson($id)
    {
        $data = [
            'data' => Lesson::where('course_id', $id)->get()
        ];
        // dd($data);
        respons()->view('main.mahasiswa.lesson', $data);
    }
}
