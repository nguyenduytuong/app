<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * @unauthenticated
     * @group Guest
     * @bodyParam login_field string required The login field.
     * @bodyParam password string required The password.
     * @bodyParam device_name string required The device name.
     */
    public function login(LoginRequest $request)
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.

        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $user = User::where('users.email', $request->input('email'))->first();
        // dd($user->password);
        if (isset($user)) {
            if (!\Hash::check($request->input('password'), $user->password)) {
                $this->incrementLoginAttempts($request);
                $responseData = ['errors' => __('messages.credential_invalid')];
            } else {
                $responseData = [
                    'token' => $user->createToken(
                        $request->input('device_name')
                    )->plainTextToken,
                    'is_email_verified' =>
                        (bool) $user->email_verified_at ?? false,
                    // 'data' => new UserResource($user),
                ];
            }

            return response()->json($responseData);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }



    // public function login(LoginRequest $request)
    // {
    //     // If the class is using the ThrottlesLogins trait, we can automatically throttle
    //     // the login attempts for this application. We'll key this by the username and
    //     // the IP address of the client making these requests into this application.

    //     if (
    //         method_exists($this, 'hasTooManyLoginAttempts') &&
    //         $this->hasTooManyLoginAttempts($request)
    //     ) {
    //         $this->fireLockoutEvent($request);

    //         return $this->sendLockoutResponse($request);
    //     }
    //     $credentials = $request->only('email', 'password');

    //     $token = Auth::attempt($credentials);
    //     // dd($token);
    //     $user = Auth::user();
    //     // $user = User::where('users.email', $request->input('email'))->first();
    //     if (isset($token)) {
    //         if (!\Hash::check($request->input('password'), $user->password)) {
    //             $this->incrementLoginAttempts($request);
    //             $responseData = ['errors' => __('messages.credential_invalid')];
    //         } else {

    //             $responseData = [
    //                 'token' => $token,
    //                 'is_email_verified' =>(bool) $user->email_verified_at ?? false,
    //                 'status' => 'success',
    //                 'user' => $user,
    //             ];
    //         }

    //         return response()->json($responseData);
    //     }

    //     // If the login attempt was unsuccessful we will increment the number of attempts
    //     // to login and redirect the user back to the login form. Of course, when this
    //     // user surpasses their maximum number of attempts they will get locked out.
    //     $this->incrementLoginAttempts($request);

    //     return $this->sendFailedLoginResponse($request);
    // }

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    // }
}
