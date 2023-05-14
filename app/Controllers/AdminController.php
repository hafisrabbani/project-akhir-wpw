<?php

namespace App\Controllers;

use App\Helpers\Debug;
use App\Models\Role;
use App\Models\User;
// use App\Helpers\Response;

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

        $data = User::create([
            'name' => $name,
            'email' => $email,
            'role_id' => $role,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        respons()->setStatusCode($data ? 200 : 400)->json($data ? ['message' => 'Berhasil menambahkan data'] : ['message' => 'Gagal menambahkan data']);
    }

    public function manageUserEdit($id)
    {
        $data = User::select(['user_id', 'name', 'email', 'role_id'])
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
        $password = input()->post('password');

        if (!$name || !$email || !$role) {
            respons()->setStatusCode(400)->json(['message' => 'Data tidak lengkap']);
            exit;
        }

        if (User::where('email', $email)->where('user_id', '!=', $id)->first()) {
            respons()->setStatusCode(400)->json(['message' => 'Email sudah terdaftar']);
            exit;
        }

        $user = User::find($id);
        $update = $user->update([
            'name' => $name,
            'email' => $email,
            'role_id' => $role,
            'password' => $password ? password_hash($password, PASSWORD_DEFAULT) : $user->password
        ]);

        respons()->setStatusCode($update ? 200 : 400)->json($update ? ['message' => 'Berhasil mengubah data'] : ['message' => 'Gagal mengubah data']);
    }
}
