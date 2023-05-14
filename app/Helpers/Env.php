<?php

namespace App\Helpers;

class Env
{
    protected static $vars;

    public static function load()
    {
        if (!file_exists(BASE_PATH . '.env')) {
            throw new \RuntimeException('The .env file does not exist');
        }

        $lines = file(BASE_PATH . '.env');

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || $line[0] === '#') {
                continue;
            }

            $parts = explode('=', $line, 2);
            if (count($parts) !== 2) {
                continue;
            }

            self::$vars[$parts[0]] = $parts[1];
        }
    }

    public static function get($name, $default = null)
    {
        if (!self::$vars) {
            self::load();
        }

        return self::$vars[$name] ?? $default;
    }
}
