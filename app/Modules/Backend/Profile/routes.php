<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Modules\Backend\Profile\Controllers';
Route::group(
    ['module' => 'Profile','prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web', 'auth']],
    function () {
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [
                'as' => 'profile.index',
                'uses' => 'ProfileController@index',
            ]);

            Route::post('/update/club', [
                'as' => 'profile.update.club',
                'uses' => 'ProfileController@update_club',
            ]);

            Route::post('/update/bio', [
                'as' => 'profile.update.bio',
                'uses' => 'ProfileController@update_bio',
            ]);

            Route::post('/update/password', [
                'as' => 'profile.update.password',
                'uses' => 'ProfileController@update_password',
            ]);

            Route::post('/update/avatar', [
                'as' => 'profile.update.avatar',
                'uses' => 'ProfileController@update_avatar',
            ]);
        });
    }
);
