<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Language;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LoginController extends Controller {

    use AuthenticatesUsers;

    public $language;
    public $data = array();
    protected $redirectTo = '';

    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
        $language = new Language();
        $this->language = $language->language;
        $this->data['language'] = $this->language;
        session()->put('language', $this->language);
       // dd(session()->get('language'));
        $this->redirectTo = '/' . $this->language . '/home';
        
    }

    public function showLoginForm() {
        return view('auth.login')->with($this->data);
    }

    public function login(Request $request) {
        $this->validateLogin($request);

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
        $auth_id = Auth::id();
        DB::table('users')
                ->where('id', $auth_id)
                ->update(['online' => 1]);
        return $this->sendFailedLoginResponse($request);
                
    }

    public function logout(Request $request,$language) {
        $currentuser = Auth::user()->id;
        DB::table('users')
                ->where('id', $currentuser)
                ->update(['online' => 0]);
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect($language . '/login');
    }

}
