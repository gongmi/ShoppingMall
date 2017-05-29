<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
        $prev = $_SERVER["HTTP_REFERER"];
        if (!Session::get('member')) {
            return redirect('/login?return_url=' . urlencode($prev));
        }

        return $next($request);
    }
}
