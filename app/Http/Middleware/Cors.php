<?php
namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class Cors
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:4200');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Allow', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Origin, X-XSRF-TOKEN');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        return $response;
    }
}
