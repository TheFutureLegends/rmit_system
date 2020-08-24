<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Modules\Backend\Teams\Controllers';
Route::group(
    ['module' => 'Teams','prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web', 'auth']],
    function () {
        Route::group(['prefix' => 'teams'], function () {
            // Route::get('/', [
            //     'as' => 'teams.index',
            //     'uses' => 'TeamController@index'
            // ]);

            // Route::post('/dataTable', [
            //     'as' => 'teams.dataTable',
            //     'uses' => 'TeamController@dataTable'
            // ]);

            // Route::post('/loadOptions', [
            //     'as' => 'teams.loadOptions',
            //     'uses' => 'TeamController@loadOptions'
            // ]);
        });

        Route::group(['prefix' => 'team'], function () {
            // Route::get('/create', [
            //     'as' => 'team.create',
            //     'uses' => 'TeamController@create'
            // ]);

            // Route::post('/store', [
            //     'as' => 'team.store',
            //     'uses' => 'TeamController@store'
            // ]);

            // Route::get('/edit/{slug}', [
            //     'as' => 'team.edit',
            //     'uses' => 'TeamController@edit'
            // ]);

            // Route::put('/update/{slug}', [
            //    'as' => 'team.update',
            //    'uses' => 'TeamController@update'
            // ]);

            // Route::delete('/delete/{slug}', [
            //     'as' => 'team.destroy',
            //     'uses' => 'TeamController@destroy'
            // ]);
        });
    }
);
