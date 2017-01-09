<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Language;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '';
    public $language;
    public $data = array();

    public function __construct() {
        $this->middleware('guest');
        $language = new Language();
        $this->language = $language->language;
        $this->data['language'] = $this->language;
        $this->redirectTo = '/' . $this->language . '/home';
    }

    public function showRegistrationForm() {

        return view('auth.register')->with($this->data);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'online' => 0,
        ]);
    }

}
