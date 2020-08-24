<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Modules\Backend\Events\Controllers';
Route::group(
    ['module' => 'Events','prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web', 'auth', 'permission:event.view|event.create|event.edit|event.delete']],
    function () {
        Route::group(['prefix' => 'events'], function () {
            Route::get('/', [
                'as' => 'events.index',
                'uses' => 'EventController@index'
            ]);

            Route::post('/dataTable', [
                'as' => 'events.dataTable',
                'uses' => 'EventController@dataTable'
            ]);
        });

        Route::group(['prefix' => 'event'], function () {
            Route::post('/feedback', [
                'middleware' => ['role:super-admin|admin|advisor'],
                'as' => 'event.feedback',
                'uses' => 'EventController@feedback'
            ]);

            Route::get('/create', [
                'middleware' => ['permission:event.create'],
                'as' => 'event.create',
                'uses' => 'EventController@create'
            ]);

            Route::post('/store', [
                'middleware' => ['permission:event.create'],
                'as' => 'event.store',
                'uses' => 'EventController@store'
            ]);

            Route::get('/show/{slug}', [
                'middleware' => ['permission:event.view'],
                'as' => 'event.show',
                'uses' => 'EventController@show'
            ]);

            Route::get('/edit/{slug}', [
                'middleware' => ['permission:event.update'],
                'as' => 'event.edit',
                'uses' => 'EventController@edit'
            ]);

            Route::put('/update/{slug}', [
                'middleware' => ['permission:event.update'],
               'as' => 'event.update',
               'uses' => 'EventController@update'
            ]);

            Route::delete('/delete/{slug}', [
                'middleware' => ['permission:event.delete'],
                'as' => 'event.destroy',
                'uses' => 'EventController@destroy'
            ]);
        });
    }
);
