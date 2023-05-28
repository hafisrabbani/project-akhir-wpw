<?php

namespace App\Controllers;

use App\Helpers\Debug;
use App\Models\User;
use Pecee\SimpleRouter\SimpleRouter as Router;


class AuthController extends BaseController
{
    public function index()
    {
        $rememberToken = $_COOKIE['remember_token'] ?? null;
        if ($rememberToken) {
            $user = User::where('remember_token', $rememberToken)->first();
            if (!$user) {
                respons()->view('login');
            } else {
                session()->put('admin', $user);
                redirect(BASE_URL . Router::getUrl('dashboard'));
            }
        }
        respons()->view('login');
    }


    public function login()
    {
        $email = input()->post('email');
        $password = input()->post('password');
        $remember = input()->post('remember');
        $user = User::where('email', $email)->first();
        // dd($user);
        if ($user) {
            if (password_verify($password, $user->password)) {
                if ($remember) {
                    $rememberToken = $user->remember_token;
                    if (!$rememberToken) {
                        $rememberToken = bin2hex(random_bytes(32));
                        $user->remember_token = $rememberToken;
                        $user->save();
                    }
                    setcookie('remember_token', $rememberToken, time() + 3600 * 24 * 30, '/');
                }
                session()->put('user', $user);
                redirect(BASE_URL . Router::getUrl('dashboard'));
            } else {
                session()->put('error', 'Password salah');
                redirect(BASE_URL . Router::getUrl('login'));
            }
        } else {
            session()->put('error', 'Username tidak ditemukan');
            redirect(BASE_URL . Router::getUrl('login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        setcookie('remember_token', '', time() - 3600, '/');
        redirect(BASE_URL . Router::getUrl('login'));
    }
}
