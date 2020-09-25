<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Modules\Backend\Users\Controllers';
Route::group(
    ['module' => 'Users','prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web', 'auth']],
    function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [
                'as' => 'users.index',
                'uses' => 'UserController@index'
            ]);

            Route::post('/dataTable', [
                'as' => 'users.dataTable',
                'uses' => 'UserController@dataTable'
            ]);

            Route::post('/loadAdvisorOptions', [
                'as' => 'users.loadAdvisorOptions',
                'uses' => 'UserController@loadAdvisorOptions'
            ]);

            Route::post('/loadAdvisorWithNoClubOptions', [
                'middleware' => ['role:super-admin|admin'],
                'as' => 'users.loadAdvisorWithNoClubOptions',
                'uses' => 'UserController@loadAdvisorWithNoClubOptions'
            ]);

            Route::post('/loadPresidentOptions', [
                'as' => 'users.loadPresidentOptions',
                'uses' => 'UserController@loadPresidentOptions'
            ]);
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/show/{email}', [
                'as' => 'user.show',
                'uses' => 'UserController@show'
            ]);

            Route::get('/create', [
                'as' => 'user.create',
                'uses' => 'UserController@create'
            ]);

            Route::post('/store', [
                'as' => 'user.store',
                'uses' => 'UserController@store'
            ]);

            Route::get('/transfer/{email}', [
                'middleware' => ['role:super-admin|admin'],
                'as' => 'user.transfer',
                'uses' => 'UserController@transfer'
            ]);

            Route::put('/update/{email}', [
               'as' => 'user.update',
               'uses' => 'UserController@update'
            ]);

            Route::delete('/delete/{email}', [
                'as' => 'user.destroy',
                'uses' => 'UserController@destroy'
            ]);
        });
    }
);
