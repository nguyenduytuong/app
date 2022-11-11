<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::any('adminer', '\Aranyasen\LaravelAdminer\AdminerController@index');
//  Route::post('auth/login-social', [
//     LoginController::class,
//     'socialLogin',
// ])->name('socialLogin');

Route::get('auth/google', [LoginController::class, 'redirect'])->name('redirect');
Route::get('google/call-back', [LoginController::class, 'socialLogin'])->name('socialLogin');

Route::get('auth/facebook', [LoginController::class, 'facebookRedirect'])->name('facebookRedirect');
Route::get('facebook/call-back', [LoginController::class, 'loginWithFacebook'])->name('loginWithFacebook');

Route::group(
    ['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']],
    function () {
        Route::get('/home', function () {
            return view('welcome');
        });

        //Users
        Route::resource('users', UserController::class, [
            'except' => ['store', 'update', 'destroy'],
        ]);
    }
);
