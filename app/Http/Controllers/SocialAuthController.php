<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SocialAccountService;

use Socialite;

use Auth;
use DB;

class SocialAuthController extends Controller
{
	public function redirect($provider=null)
	{
		return Socialite::driver($provider)->redirect();
	}    

	public function callback($provider=null, SocialAccountService $service)
	{
		$user = $service->createOrGetUser($provider,Socialite::driver($provider)->user());
		auth()->login($user);
        $auth_id = Auth::id();
        $update = DB::table('users')->where('id', '=', $auth_id)->update(['online' => 1]);
		return redirect('home');
	}
}