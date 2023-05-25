<?php

namespace App\Controllers;

use App\Models\Assignment;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Submission;

class MahasiswaController extends BaseController
{
    public function __construct()
    {
        session()->get('user')->roles->role_name == 'mahasiswa' ? '' : redirect(BASE_URL . '/dashboard');
    }
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
        respons()->view('main.mahasiswa.lesson', $data);
    }

    public function listAssignment($id)
    {
        $userId = session()->get('user')->user_id;
        $assignment = Assignment::leftJoin('submissions', function ($join) use ($userId) {
            $join->on('assignments.assignment_id', '=', 'submissions.assignment_id')
                ->where('submissions.user_id', '=', $userId);
        })
            ->where('assignments.course_id', $id)
            ->select('assignments.*', 'submissions.submission_id as submission_id', 'submissions.file', 'submissions.created_at as uploaded_at')
            ->get();
        $data = [
            'data' => $assignment,
            'course_id' => $id
        ];

        respons()->view('main.mahasiswa.assignments', $data);
    }

    public function assignmentPost($id)
    {
        $file = input()->file('file') ?? false;
        $content = input()->post('description');
        if (!$content) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }
        if ($file) {
            $destination = public_path() . 'files/tugas';
            // dd($destination);
            $allowedExt = ['jpg', 'jpeg', 'png', 'pdf'];
            $validate = fileHandler()->validateUpload('file', $allowedExt);
            if ($validate) {
                $fileName = time() . '_' . $file->filename;
                $Upload = fileHandler()->upload('file', $destination, $allowedExt, $fileName) ?? false;
                if (!$Upload) {
                    respons()->setStatusCode(400)->json(['error' => 'failed upload']);
                }
            }
            var_dump($id);
            $data = Submission::updateOrCreate([
                'user_id' => session()->get('user')->user_id,
                'assignment_id' => $id
            ], [
                'assignment_id' => $id,
                'user_id' => session()->get('user')->user_id,
                'submission_time' => date('Y-m-d H:i:s'),
                'content' => $content,
                'file' => $Upload['file_name']
            ]);

            respons()->setStatusCode($data ? 200 : 400)->json($data ? ['message' => 'Berhasil menambahkan data'] : ['message' => 'Gagal menambahkan data']);
        }
    }
}
