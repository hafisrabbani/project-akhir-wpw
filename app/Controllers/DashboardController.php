<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        respons()->view('main.dashboard');
    }
}
