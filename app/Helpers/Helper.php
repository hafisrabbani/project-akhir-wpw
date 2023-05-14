<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response;
use Pecee\Http\Request;

if (!function_exists('asset')) {
    function asset($path)
    {
        return BASE_URL . '/' . $path;
    }
}

if (!function_exists('redirect')) {
    function redirect($path)
    {
        // check if starts with http or https or www
        if (strpos($path, 'http') === 0 || strpos($path, 'www.') === 0 || strpos($path, 'https') === 0) {
            $url = $path;
        } else {
            $url = BASE_URL . '/' . $path;
        }
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        exit();
    }
}

if (!function_exists('route')) {
    function route(?string $name = null, $parameters = null, ?array $getParams = null): string
    {
        return BASE_URL . Router::getUrl($name, $parameters, $getParams);
    }
}

if (!function_exists('response')) {
    function response(): Response
    {
        return Router::response();
    }
}

if (!function_exists('request')) {
    function request(): Request
    {
        return Router::request();
    }
}

if (!function_exists('input')) {
    function input($index = null, $defaultValue = null, ...$methods)
    {
        if ($index !== null) {
            return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
        }

        return request()->getInputHandler();
    }
}

if (!function_exists('redirect')) {
    function redirect(string $url, ?int $code = null): void
    {
        if ($code !== null) {
            response()->httpCode($code);
        }

        response()->redirect($url);
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token(): ?string
    {
        $baseVerifier = Router::router()->getCsrfVerifier();
        if ($baseVerifier !== null) {
            return $baseVerifier->getTokenProvider()->getToken();
        }

        return null;
    }
}


if (!function_exists('move_file')) {
    function move_file($file, $path, $name = null)
    {
        $name = $name ?? $file['name'];
        $path = $path . '/' . $name;
        move_uploaded_file($file['tmp_name'], $path);
        return $path;
    }
}

if (!function_exists('session')) {
    function session()
    {
        return new \App\Helpers\Session();
    }
}
