<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse\Json\JsonResponse;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if($request->is("admin*"))
                return route('admin.login');
            else if($request->is("api*"))
                return JsonResponse::error()->changeCode(200)->changeStatusNumber("S401")->send();
        }
    }
}
