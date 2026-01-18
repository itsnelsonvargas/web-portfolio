<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('admin_authenticated')) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
