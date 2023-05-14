<?php
require_once '../bootstrap/bootstrap.php';

use App\Helpers\Env;
use Pecee\SimpleRouter\SimpleRouter as Route;
use Pecee\Http\Request;

require_once APP_PATH . '/Helpers/Helper.php';

Env::load();

Route::setDefaultNamespace('\App\Controllers');
require_once BASE_PATH . 'config/routes.php';
// error routes
Route::error(function (Request $request, \Exception $exception) {
    $handler = new \App\Exceptions\Handler();
    $error = $handler->codeException($exception);
    global $blade;
    // switch ($error['code']) {
    //     case 404:
    //         echo $blade->run('Framework.error.exception', ['error' => $error]);
    //         break;
    //     case 500:
    //         if (Env::get('DEBUG_MODE') == 'true') {
    //             echo $blade->run('Framework.error.500', ['error' => $error]);
    //         } else {
    //             $error = [
    //                 'code' => 500,
    //                 'message' => 'Internal Server Error',
    //             ];
    //             echo $blade->run('Framework.error.exception', ['error' => $error]);
    //         }
    //         break;
    //     default:
    //         echo $this->blade->run('Framework.error.exception', ['error' => $error]);
    //         break;
    // }
});
Route::start();
