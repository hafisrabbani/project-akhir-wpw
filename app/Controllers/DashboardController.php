<?php

namespace App\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [];
        $roles = session()->get('user')->roles->role_name;
        switch ($roles) {
            case 'administrator':
                $data = [
                    'total_dosen' => User::where('role_id', 2)->count(),
                    'total_mhs' => User::where('role_id', 1)->count(),
                    'total_matkul' => Course::count(),
                ];
                break;
            case 'dosen':
                $userId = session()->get('user')->user_id;

                $lessons = Lesson::join('courses', 'lessons.course_id', '=', 'courses.course_id')
                    ->where('courses.instructor_id', $userId)
                    ->get();

                $totalMatkul = Course::where('instructor_id', $userId)->count();
                $totalMateri = $lessons->count();

                $data = [
                    'total_matkul' => Course::where('instructor_id', $userId)->count(),
                    'total_materi' => $lessons->count(),
                ];
                break;
            case 'mahasiswa':

            default:
                break;
        }
        respons()->view('main.dashboard', $data);
    }
}
