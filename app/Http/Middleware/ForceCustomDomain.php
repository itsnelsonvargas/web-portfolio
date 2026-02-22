<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceCustomDomain
{
    public function handle(Request $request, Closure $next)
    {
        if (
            app()->environment('production') &&
            $request->getHost() === 'nelsonvargas.onrender.com'
        ) {
            return redirect()->to('https://nelvargas.com', 301);
        }

        return $next($request);
    }
}
