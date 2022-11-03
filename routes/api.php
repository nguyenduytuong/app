<?php

use App\Http\Controllers\API\Auth;
use App\Http\Controllers\ProfanityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['as' => '.api'], function () {
    Route::post('login',  [Auth\LoginController::class, 'login'])->name('login');

    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::post('forgot', [
            Auth\ForgotPasswordController::class,
            'sendResetLinkEmail',
        ])->name('sendResetLinkEmail.forgot');
    });
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware('auth:sanctum')->group(function () {
    Route::post('profanity', [ProfanityController::class, 'create'])->name('create');
    Route::get('profanity/all', [ProfanityController::class, 'index'])->name('index');
});
