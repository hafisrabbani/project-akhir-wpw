<?php

namespace App\Controllers;

use App\Helpers\Debug;
use App\Models\Role;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Course;

class AdminController extends BaseController
{
    public function __construct()
    {
        session()->get('user')->roles->role_name == 'administrator' ? '' : redirect(BASE_URL . '/dashboard');
    }

    public function manageUser()
    {
        $data = [
            'data' => User::where('role_id', '!=', 3)->get(),
            'roles' => Role::all()
        ];
        respons()->view('main.user-manage', $data);
    }

    public function manageUserPost()
    {
        $name = input()->post('name');
        $email = input()->post('email');
        $nrp = input()->post('nrp') ?? null;
        $role = input()->post('role');
        $password = input()->post('password');

        if (!$name || !$email || !$role || !$password) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }

        if (User::where('email', $email)->first()) {
            respons()->setStatusCode(400)->json(['message' => 'Email sudah terdaftar']);
            exit;
        }

        if ($nrp && User::where('nrp', $nrp)->first()) {
            respons()->setStatusCode(400)->json(['message' => 'NRP sudah terdaftar']);
            exit;
        }

        $data = User::create([
            'name' => $name,
            'nrp' => $nrp,
            'email' => $email,
            'role_id' => $role,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        respons()->setStatusCode($data ? 200 : 400)->json($data ? ['message' => 'Berhasil menambahkan data'] : ['message' => 'Gagal menambahkan data']);
    }

    public function manageUserEdit($id)
    {
        $data = User::select(['user_id', 'name', 'email', 'role_id', 'nrp'])
            ->where('user_id', $id)
            ->with('roles', function ($query) {
                $query->select(['role_id', 'role_name']);
            })
            ->first();
        if (!$data) {
            respons()->setStatusCode(404)->json(['message' => 'Data tidak ditemukan']);
        }

        respons()->json($data);
    }

    public function manageUserEditPost($id)
    {
        $name = input()->post('name');
        $email = input()->post('email');
        $role = input()->post('role');
        $nrp = input()->post('nrp');
        $password = input()->post('password');

        if (!$name || !$email || !$role) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }

        if (User::where('email', $email)->where('user_id', '!=', $id)->first()) {
            respons()->setStatusCode(400)->json(['message' => 'Email sudah terdaftar']);
            exit;
        }

        $nrp = $nrp ? $nrp : null;
        if ($nrp && User::where('nrp', $nrp)->where('user_id', '!=', $id)->first()) {
            respons()->setStatusCode(400)->json(['message' => 'NRP sudah terdaftar']);
            exit;
        }

        $user = User::find($id);
        $update = $user->update([
            'name' => $name,
            'email' => $email,
            'nrp' => $nrp,
            'role_id' => $role,
            'password' => $password ? password_hash($password, PASSWORD_DEFAULT) : $user->password
        ]);

        respons()->setStatusCode($update ? 200 : 400)->json($update ? ['message' => 'Berhasil mengubah data'] : ['message' => 'Gagal mengubah data']);
    }

    public function manageUserDelete($id)
    {
        $user = User::find($id);
        if (!$user) {
            respons()->setStatusCode(404)->json(['message' => 'Data tidak ditemukan']);
        }

        $delete = $user->delete();

        respons()->setStatusCode($delete ? 200 : 400)->json($delete ? ['message' => 'Berhasil menghapus data'] : ['message' => 'Gagal menghapus data']);
    }


    public function courses()
    {
        $data = [
            'data' => Course::all(),
            'dosen' => User::whereHas('roles', function ($query) {
                $query->where('role_name', 'dosen');
            })->get()
        ];

        respons()->view('main.courses', $data);
    }

    public function coursesPost()
    {
        $name = input()->post('name');
        $description = input()->post('description');
        $dosen = input()->post('dosen');

        if (!$name || !$description || !$dosen) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }

        $data = Course::create([
            'course_name' => $name,
            'description' => $description,
            'instructor_id' => $dosen
        ]);

        respons()->setStatusCode($data ? 200 : 400)->json($data ? ['message' => 'Berhasil menambahkan data'] : ['message' => 'Gagal menambahkan data']);
    }

    public function coursesEdit($id)
    {
        $data = Course::find($id);
        if (!$data) {
            respons()->setStatusCode(404)->json(['message' => 'Data tidak ditemukan']);
        }

        respons()->json($data);
    }

    public function coursesEditPost($id)
    {
        $name = input()->post('name');
        $description = input()->post('description');
        $dosen = input()->post('dosen');

        if (!$name || !$description || !$dosen) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }

        $course = Course::find($id);
        $update = $course->update([
            'course_name' => $name,
            'description' => $description,
            'instructor_id' => $dosen
        ]);

        respons()->setStatusCode($update ? 200 : 400)->json($update ? ['message' => 'Berhasil mengubah data'] : ['message' => 'Gagal mengubah data']);
    }

    public function enrollment()
    {
        $data = [
            'data' => Enrollment::all(),
            'courses' => Course::all(),
            'students' => User::whereHas('roles', function ($query) {
                $query->where('role_name', '=', 'mahasiswa');
            })->select(['user_id', 'name'])->get()
        ];

        respons()->view('main.enrollments', $data);
    }

    public function enrollmentPost()
    {
        $mahasiswa = input()->post('mahasiswa');
        $matkul = input()->post('matkul');

        if (!$mahasiswa || !$matkul) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }

        $data = Enrollment::create([
            'user_id' => $mahasiswa,
            'course_id' => $matkul
        ]);

        respons()->setStatusCode($data ? 200 : 400)->json($data ? ['message' => 'Berhasil menambahkan data'] : ['message' => 'Gagal menambahkan data']);
    }

    public function enrollmentEdit($id)
    {
        $data = Enrollment::find($id);
        if (!$data) {
            respons()->setStatusCode(404)->json(['message' => 'Data tidak ditemukan']);
        }

        respons()->json($data);
    }

    public function enrollmentEditPost($id)
    {
        $mahasiswa = input()->post('mahasiswa');
        $matkul = input()->post('matkul');

        if (!$mahasiswa || !$matkul) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }

        $enrollment = Enrollment::find($id);
        $update = $enrollment->update([
            'user_id' => $mahasiswa,
            'course_id' => $matkul
        ]);

        respons()->setStatusCode($update ? 200 : 400)->json($update ? ['message' => 'Berhasil mengubah data'] : ['message' => 'Gagal mengubah data']);
    }
}
