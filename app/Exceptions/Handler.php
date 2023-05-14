<?php

namespace App\Exceptions;

use App\Helpers\Env;

class Handler
{
    public function __construct()
    {
        if (Env::get('DEBUG_MODE') == 'true') {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        } else {
            error_reporting(0);
            ini_set('display_errors', '0');
        }
    }

    private function logging($e)
    {
        $message = $e->getMessage();
        $code = $e->getCode();
        $file = $e->getFile();
        $line = $e->getLine();
        $trace = $e->getTraceAsString();
        error_log(
            "Type: CodeException\n" .
                "Time: " . date('Y-m-d H:i:s') . "\n" .
                "Message: $message\n" .
                "Code: $code\n" .
                "File: $file\n" .
                "Line: $line\n" .
                "Trace: $trace\n\n\n",
            3,
            BASE_PATH . '/storage/logs/errors.log'

        );
    }

    public function codeException(\Throwable $e)
    {
        $message = $e->getMessage();
        $code = $e->getCode();
        $file = $e->getFile();
        $line = $e->getLine();
        $trace = $e->getTraceAsString();
        $this->logging($e);
        return [
            'message' => $message,
            'code' => $code,
            'file' => $file,
            'line' => $line,
            'trace' => $trace
        ];
    }


    public function DBException(\Throwable $e)
    {
        $message = $e->getMessage();
        $code = $e->getCode();
        $file = $e->getFile();
        $line = $e->getLine();
        $trace = $e->getTraceAsString();
        $this->logging($e);
        return [
            'message' => $message,
            'code' => $code,
            'file' => $file,
            'line' => $line,
            'trace' => $trace
        ];
    }

    public function Handler($e)
    {
        if ($e instanceof \PDOException) {
            $error = $this->DBException($e);
        } else {
            $error = $this->codeException($e);
        }

        return $error;
    }
}
