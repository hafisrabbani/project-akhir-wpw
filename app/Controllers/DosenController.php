<?php

namespace App\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;

class DosenController extends BaseController
{
    public function __construct()
    {
        session()->get('user')->roles->role_name == 'dosen' ? '' : redirect(BASE_URL . '/dashboard');
    }

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

    public function listCourseLessonDetail($lesson_id)
    {
        $data = Lesson::findOrFail($lesson_id);
        if (!$data) {
            respons()->setStatusCode(404)->json(['message' => 'Data tidak ditemukan']);
        }

        respons()->json($data);
    }

    public function listCourseLessonUpdate($lesson_id)
    {
        $lesson_name = input()->post('judul');
        $content = input()->post('content');

        if (!$lesson_name || !$content) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }
        $data = Lesson::findOrFail($lesson_id);
        if (!$data) {
            respons()->setStatusCode(404)->json(['message' => 'Data tidak ditemukan']);
        }

        $data->update([
            'lesson_name' => $lesson_name,
            'content' => $content,
        ]);

        respons()->setStatusCode($data ? 200 : 400)->json($data ? ['message' => 'Berhasil mengubah data'] : ['message' => 'Gagal mengubah data']);
    }

    public function lessonDelete($id)
    {
        $user = Lesson::find($id);
        if (!$user) {
            respons()->setStatusCode(404)->json(['message' => 'Data tidak ditemukan']);
        }

        $delete = $user->delete();

        respons()->setStatusCode($delete ? 200 : 400)->json($delete ? ['message' => 'Berhasil menghapus data'] : ['message' => 'Gagal menghapus data']);
    }

    public function listMHs($id)
    {
        $data = Enrollment::with('users')->where('course_id', $id)->get();
        if (!$data) {
            respons()->setStatusCode(404)->json(['message' => 'Data tidak ditemukan']);
        }

        respons()->json($data);
    }

    public function assignmentList($id)
    {
        $data = [
            'data' => Assignment::where('course_id', $id)->get(),
            'id_course' => $id
        ];

        respons()->view('main.dosen.assignment', $data);
    }

    public function assignmentPost($id)
    {
        $name = input()->post('name');
        $description = input()->post('description');
        $deadline = input()->post('deadline');
        if (!$name || !$description || !$deadline) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }
        $data = Assignment::create([
            'assignment_name' => $name,
            'description' => $description,
            'deadline' => $deadline,
            'course_id' => $id
        ]);

        respons()->setStatusCode($data ? 200 : 400)->json($data ? ['message' => 'Berhasil menambahkan data'] : ['message' => 'Gagal menambahkan data']);
    }

    public function assignmentDetail($id)
    {
        $data = Assignment::findOrFail($id)->first();
        if (!$data) {
            respons()->setStatusCode(404)->json(['message' => 'Data tidak ditemukan']);
        }
        respons()->json($data);
    }

    public function assignmentUpdate($id)
    {
        $name = input()->post('name');
        $description = input()->post('description');
        $deadline = input()->post('deadline');
        if (!$name || !$description || !$deadline) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }

        $data = Assignment::findOrFail($id);
        $data->update([
            'assignment_name' => $name,
            'description' => $description,
            'deadline' => $deadline
        ]);

        respons()->setStatusCode($data ? 200 : 400)->json($data ? ['message' => 'Berhasil mengubah data'] : ['message' => 'Gagal mengubah data']);
    }

    public function assignmentDelete($id)
    {
        $delete = Assignment::findOrFail($id);
        $delete->delete();
        respons()->setStatusCode($delete ? 200 : 400)->json($delete ? ['message' => 'Berhasil menghapus data'] : ['message' => 'Gagal menghapus data']);
    }
}
