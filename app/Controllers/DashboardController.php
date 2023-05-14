<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        echo $this->view('main.dashboard');
    }
}
