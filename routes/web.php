<?php

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

Route::group(
    ['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']],
    function () {
        Route::get('/home', function () {
            return view('welcome');
        });
    }
);
