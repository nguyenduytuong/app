<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
