<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;



    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Where to redirect users after login.
     *
     *
     * @return string
     */
    public function redirectPath(): string
    {
        // if(auth()->user()->getIsVenueAttribute()){

        //     return RouteServiceProvider::VENUE;
        // }
        return RouteServiceProvider::HOME;
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function socialLogin()
    {
        
            $user = Socialite::driver('google')->user();
            $finduser = User::where('provider_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/admin/users');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id' => $user->id,
                    'provider_name' => 'google',
                ]);

                Auth::login($newUser);

                return redirect('/admin/users');
            }
    }

    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
    
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('provider_id', $user->id)->first();
        // dd($user);
            if($isUser){
                Auth::login($isUser);
                return redirect('/admin/users');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id' => $user->id,
                    'provider_name' => 'facebook',
                ]);
    
                Auth::login($createUser);
                return redirect('/admin/users');
            }
    }



    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // protected function credentials(\Illuminate\Http\Request $request)
    // {
    //     return array_merge($request->only($this->username(), 'password'), [
    //         'status' => 'active'
    //     ]);
    // }
}
