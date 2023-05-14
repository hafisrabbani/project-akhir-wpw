<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;

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
        echo $this->view('main.user-manage', $data);
    }
}
