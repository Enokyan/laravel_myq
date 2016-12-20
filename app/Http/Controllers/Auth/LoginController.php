<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class LoginController extends Controller
{


    use AuthenticatesUsers;


    protected $redirectTo = '/home';

    public function __construct()
    {

        $this->middleware('guest', ['except' => 'logout']);

    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        $auth_id=Auth::id();
        DB::table('users')
            ->where('id', $auth_id)
            ->update(['online' => 1]);
        return $this->sendFailedLoginResponse($request);
    }


    public function logout(Request $request) {
        $currentuser = Auth::user()->id;
        DB::table('users')
            ->where('id', $currentuser)
            ->update(['online' => 0]);
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect( '/login');
    }
}
