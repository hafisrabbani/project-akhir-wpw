<?php

namespace App\Filters;

use App\Filters\Filter;
use Pecee\Http\Request;

class Roles implements Filter
{
    public function handle(Request $request): void
    {
        require_once __DIR__ . '/../Helpers/Helper.php';
        if (!session()->has('user')) {
            redirect(BASE_URL . '/');
        }
    }
}
