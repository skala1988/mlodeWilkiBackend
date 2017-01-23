<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Routing\Middleware\ThrottleRequests;
use App\Http\Controllers\MyHttpController;

class ThrottleRequestsOverride extends ThrottleRequests
{
    /**
     * Create a 'too many attempts' response.
     *
     * @param  string  $key
     * @param  int  $maxAttempts
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function buildResponse($key, $maxAttempts)
    {
        $retryAfter = $this->limiter->availableIn($key);
        return MyHttpController::createResponse(false, 429, ['Too many attempts. Try again in '.$retryAfter.'s.']);
    }
}
