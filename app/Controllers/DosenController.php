<?php

namespace App\Controllers;

use App\Models\Course;
use App\Models\Lesson;

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
            // 'data' => Course::where('course_id', $id)->with('enrollments', function ($query) {
            //     $query->with('users', function ($query) {
            //         $query->select(['user_id', 'name', 'email']);
            //     });
            // })->first(),
            'lessons' => Lesson::where('course_id', $id)->get(),
            'id_course' => $id
        ];
        respons()->view('main.dosen.lesson-list', $data);
    }


    public function lessonCreate($course_id)
    {
        $lesson_name = input()->post('judul');
        $content = input()->post('content');

        if (!$lesson_name || !$content) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }

        $data = Lesson::create([
            'lesson_name' => $lesson_name,
            'content' => $content,
            'course_id' => $course_id,
        ]);

        respons()->setStatusCode($data ? 200 : 400)->json($data ? ['message' => 'Berhasil menambahkan data'] : ['message' => 'Gagal menambahkan data']);
    }
}
