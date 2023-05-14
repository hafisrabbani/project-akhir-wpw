<?php

define('BASE_PATH', __DIR__ . '/../');
define('APP_PATH', BASE_PATH . '/app');
require_once BASE_PATH . '/vendor/autoload.php';
require APP_PATH . '/Helpers/Env.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Exceptions\Handler;
use App\Helpers\Env;

$protocol = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] . '://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
define('BASE_URL', Env::get('APP_URL', $protocol . $host . '/'));

$viewConfig = require_once BASE_PATH . '/config/views.php';
$blade = new \eftec\bladeone\BladeOne(
    $viewConfig['views_path'],
    $viewConfig['cache_path'],
    $viewConfig['mode']
);


$capsule = new Capsule;
$dbConfig = require_once BASE_PATH . '/config/database.php';
$capsule->addConnection($dbConfig['connections'][$dbConfig['default']]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

set_exception_handler(function ($e) use ($blade) {
    $handler = new Handler();
    $error = $handler->codeException($e);
    if (Env::get('DEBUG_MODE') == 'true') {
        echo $blade->run('Framework.error.500', ['error' => $error]);
        die();
    } else {
        $error = [
            'code' => 500,
            'message' => 'Internal Server Error',
        ];
        echo $blade->run('Framework.error.exception', ['error' => $error]);
        die();
    }
});

/*-----------------------------------
Define the autoloader
-----------------------------------*/
spl_autoload_register(function ($className) {
    $directories = [
        APP_PATH . '/Controllers/',
        APP_PATH . '/Models/',
        APP_PATH . '/Helpers/',
        APP_PATH . '/Exceptions/',
        APP_PATH . '/Filters/',
        BASE_PATH . '/config/'
    ];

    foreach ($directories as $directory) {
        if (file_exists($directory . $className . '.php')) {
            require_once $directory . $className . '.php';
            return;
        }
    }
});
