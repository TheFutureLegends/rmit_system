<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Modules\Backend\Clubs\Controllers';
Route::group(
    ['module' => 'Clubs','prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web', 'auth', 'permission:club.view|club.create|club.edit|club.delete']],
    function () {
        Route::group(['prefix' => 'clubs'], function () {
            Route::get('/', [
                'as' => 'clubs.index',
                'uses' => 'ClubController@index'
            ]);

            Route::post('/dataTable', [
                'as' => 'clubs.dataTable',
                'uses' => 'ClubController@dataTable'
            ]);

            Route::post('/loadOptions', [
                'as' => 'clubs.loadOptions',
                'uses' => 'ClubController@loadOptions'
            ]);
        });

        Route::group(['prefix' => 'club'], function () {
            Route::get('/create', [
                'as' => 'club.create',
                'uses' => 'ClubController@create'
            ]);

            Route::post('/store', [
                'as' => 'club.store',
                'uses' => 'ClubController@store'
            ]);

            Route::get('/edit/{slug}', [
                'as' => 'club.edit',
                'uses' => 'ClubController@edit'
            ]);

            Route::put('/update/{slug}', [
               'as' => 'club.update',
               'uses' => 'ClubController@update'
            ]);

            Route::delete('/delete/{slug}', [
                'as' => 'club.destroy',
                'uses' => 'ClubController@destroy'
            ]);
        });
    }
);
