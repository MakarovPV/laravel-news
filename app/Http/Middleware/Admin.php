<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Проверка прав пользователя.
     * @param Request $request
     * @param Closure $next
     * @return mixed|never
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->type == 1) {
                return $next($request);
            }
            return abort(404);
    }
}
