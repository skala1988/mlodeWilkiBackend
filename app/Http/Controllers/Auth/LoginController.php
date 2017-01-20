<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }
    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return true;
    }
    /**
     * Check if user already logged.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function checkLogged()
    {
        $user = Auth::user();
        return $user!== null ? $user : false;
    }
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required',
        ]);
    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function username()
    {
        return 'email';
    }
    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }
    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        return true;
    }
    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse()
    {
        return false;
    }
}
