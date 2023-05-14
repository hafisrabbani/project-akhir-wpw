<?php

namespace App\Helpers;

class Response
{
    // status code
    private $code = 200;

    public function setStatusCode($code)
    {
        $this->code = $code;
        return $this; // tambahkan return $this agar method dapat dipanggil secara berantai
    }

    public function json($data)
    {
        header('Content-Type: application/json');
        http_response_code($this->code);
        echo json_encode($data);
        return $this; // tambahkan return $this agar method dapat dipanggil secara berantai
    }

    public function view($view, $data = [])
    {
        global $blade;
        http_response_code($this->code);
        echo $blade->run($view, $data);
        return $this;
    }

    public function redirect($url)
    {
        http_response_code($this->code);
        header('Location: ' . $url);
        return $this;
    }

    public function download($file)
    {
        http_response_code($this->code);
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: Binary');
        header('Content-disposition: attachment; filename="' . basename($file) . '"');
        readfile($file);
        return $this;
    }
}
