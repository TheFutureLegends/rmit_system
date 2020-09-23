<?php

use App\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/verify/{email}/{token}', function ($email, $token) {
    $user = User::query()
    ->where([
        ['email', '=', $email],
        ['token', '=', $token],
        ['status', '=', 0]
    ])
    ->firstOrFail();

    $user->status = 1;

    $user->token = null;

    $user->save();

    return redirect()->route('login');
});

// Auth::routes();

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
