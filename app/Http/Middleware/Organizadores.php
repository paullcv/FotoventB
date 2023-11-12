<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Organizadores
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->subscribedToPrice('price_1O8rF5Dh3Rgs6haXpoUtKkFB','Fotovent')) {
            return $next($request);
        }

        return redirect()->route('subscripcion');
    }
}
