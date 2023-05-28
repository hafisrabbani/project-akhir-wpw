<?php

namespace App\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\Submission;

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
        $attachment = input()->file('attachment') ?? false;
        if (!$lesson_name || !$content) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }
        if ($attachment) {
            $destination = public_path() . 'files/materi';
            // dd($destination);
            $allowedExt = ['jpg', 'jpeg', 'png', 'pdf', 'docx', 'doc', 'zip'];
            $validate = fileHandler()->validateUpload('attachment', $allowedExt);
            if ($validate) {
                $fileName = time() . '_' . $attachment->filename;

                $Upload = fileHandler()->upload('attachment', $destination, $allowedExt, $fileName) ?? false;
                // dd($Upload);
                if (!$Upload) {
                    respons()->setStatusCode(400)->json(['error' => 'failed upload']);
                    exit;
                }
            }
        }

        $data = Lesson::create([
            'lesson_name' => $lesson_name,
            'content' => $content,
            'attachment' => $Upload['file_name'] ?? null,
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
        $attachment = input()->file('attachment') ?? false;
        if (!$lesson_name || !$content) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }
        $data = Lesson::findOrFail($lesson_id);
        if (!$data) {
            respons()->setStatusCode(404)->json(['message' => 'Data tidak ditemukan']);
        }
        if ($attachment) {
            $destination = public_path() . 'files/materi';
            // dd($destination);
            $allowedExt = ['jpg', 'jpeg', 'png', 'pdf', 'docx', 'doc', 'zip'];
            $validate = fileHandler()->validateUpload('attachment', $allowedExt);
            if ($validate) {
                $fileName = time() . '_' . $attachment->filename;

                $Upload = fileHandler()->upload('attachment', $destination, $allowedExt, $fileName) ?? false;
                // dd($Upload);
                if (!$Upload) {
                    respons()->setStatusCode(400)->json(['error' => 'failed upload']);
                    exit;
                }
            }
        }

        $fileUploaded = $Upload['file_name'] ?? $data->attachment;
        $data->update([
            'lesson_name' => $lesson_name,
            'attachment' => $fileUploaded, // 'attachment' => $Upload['file_name'] ?? $data->attachment,
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
        $data = Assignment::where('assignment_id', $id)->first();
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


    public function assignmentSubmission($id)
    {
        $submission = Submission::where('assignment_id', $id)->get();
        $assignment = $submission[0]->assignments;
        $courseId = $assignment->course_id;

        $getMhsNotSubmit = Enrollment::where('course_id', $courseId)
            ->whereNotIn('user_id', $submission->pluck('user_id'))
            ->get();

        // Menggabungkan data mahasiswa yang belum mengumpulkan dengan data pengumpulan yang sudah ada
        $submission = $submission->concat($getMhsNotSubmit);

        $submission = $submission->map(function ($item) {
            $item->uploaded_at = $item->submission_time ? date('d-m-Y H:i:s', strtotime($item->submission_time)) : null;
            if ($item->submission_time) {
                $item->isLate = strtotime($item->assignments->deadline) < strtotime($item->submission_time) ? true : false;
            }

            // check if not have submission
            if (!$item->submission_id) {
                $item->content = null;
                $item->file = null;
                $item->submission_time = null;
                $item->isLate = null;
            }
            return $item;
        });

        // dd($submission);
        $data = [
            'data' => Assignment::where('assignment_id', $id)->first(),
            'submission' => $submission,
            'id_assignment' => $id
        ];
        respons()->view('main.dosen.submission', $data);
    }



    public function assignmentSubmissionPost($id)
    {
        $nilai = input()->post('score');
        $submission = Submission::findOrFail($id);
        if (!$submission) {
            respons()->setStatusCode(404)->json(['message' => 'Data tidak ditemukan']);
            exit;
        }


        $data = $submission->update([
            'nilai' => $nilai
        ]);

        respons()->setStatusCode($data ? 200 : 400)->json($data ? ['message' => 'Berhasil mengubah data'] : ['message' => 'Gagal mengubah data']);
        exit;
    }
}
