<?php

namespace App\Helpers;

class Debug
{
    public static function dd(...$vars)
    {
        echo '<style>body{background-color: #282c34; color: #fff; padding: 20px;font-family: Arial, sans-serif}.text-center{text-align: center;}pre{padding: 10px; background-color: #181a1f; color: #fff; overflow: auto; white-space: pre-wrap; word-wrap: break-word;}</style>';
        echo "<pre>";
        foreach ($vars as $var) {
            print_r($var);
        }
        echo "</pre>";
        self::dumpStackTrace();
        echo '<hr><br><code><center>Windz Framework | Developed by HafizR</center></code>';
        die;
    }

    public static function dumpStackTrace()
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $trace = array_slice($trace, 1);

        echo "<pre>";
        echo "<h3 style='color: #D71F1F;'>Stack Trace:</h3>";
        foreach ($trace as $index => $call) {
            $class = isset($call['class']) ? $call['class'] : '';
            $type = isset($call['type']) ? $call['type'] : '';
            $function = $call['function'];
            $file = isset($call['file']) ? $call['file'] : '';
            $line = isset($call['line']) ? $call['line'] : '';
            echo "<p><strong>{$index}.</strong> {$class}{$type}{$function}() in {$file} on line {$line}</p>";
        }
        echo "</pre>";
    }
}
