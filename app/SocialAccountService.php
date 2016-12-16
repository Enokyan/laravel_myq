<?php 
namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;
use DB;

class SocialAccountService
{
	public function createOrGetUser($provider, ProviderUser $providerUser)
	{
		$account = SocialAccount::whereProvider($provider)
			->whereProviderUserId($providerUser->getID())
			->first();
		if($account){
			return $account->user;
		} 
		else{
			$account = new SocialAccount([
				'provider_user_id' => $providerUser->getId(),
				'provider' => $provider
			]);
			$user = DB::table('social_accounts')->where('provider_user_id',$providerUser->getId())->first();

//			$user = User::whereId($providerUser->getEmail())->first();
			if(!$user){
				$user = User::create([
					'email' => $providerUser->getEmail(),
					'name' => $providerUser->getName()
				]);
			}
			$account->user()->associate($user);
			$account->save();
			return $user;
		}
	}
}
