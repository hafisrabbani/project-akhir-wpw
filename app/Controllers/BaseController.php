<?php

namespace App\Controllers;

class BaseController
{

    public function view($view, $data = [])
    {
        global $blade;
        echo $blade->run($view, $data);
    }
}
