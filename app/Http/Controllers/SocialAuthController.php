<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Redirect;
use App\Domain\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller {
	public function redirect($service) {
		return Socialite::driver($service)->redirect ();
	}
	/**
     _ Obtain the user information from provider.  Check if the user already exists in our
     _ database by looking up their provider_id in the database.
     _ If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     _ redirect them to the authenticated users homepage.
     _
     _ @return Response
     **/
    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        if($authUser[1] == 1) {
            Auth::login($authUser[0], true);
            return redirect('gift-dashboard');
        }
        if($authUser[1] == 2) {
            Auth::login($authUser[0], true);
            return redirect('parent-child-info');
        }
        
    }

    /**
     _ If a user has registered before using social auth, return the user
     _ else, create a new user object.
     _ @param  $user Socialite user object
     _ @param $provider Social auth provider
     _ @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        $is_user = User::where('email', '=', $user->email)->first();
        if ($authUser && $user != null) {
            return array($is_user, 1);
        }
        
        $user = User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
        $user = User::where('email', '=', $user->email)->first();
        return array($user, 2);
    }
	
	
}