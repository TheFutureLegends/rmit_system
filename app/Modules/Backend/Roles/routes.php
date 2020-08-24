<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Modules\Backend\Roles\Controllers';
Route::group(
    ['module' => 'Roles','prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web', 'auth' ,'role:super-admin']],
    function () {
        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [
                'as' => 'roles.index',
                'uses' => 'RolesController@index'
            ]);

            Route::post('/dataTable', [
                'as' => 'roles.dataTable',
                'uses' => 'RolesController@dataTable'
            ]);

            Route::post('/loadOptions', [
                'as' => 'roles.loadOptions',
                'uses' => 'RolesController@loadOptions'
            ]);
        });

        Route::group(['prefix' => 'role'], function () {
            Route::get('/create', [
                'as' => 'role.create',
                'uses' => 'RolesController@create'
            ]);

            Route::post('/store', [
                'as' => 'role.store',
                'uses' => 'RolesController@store'
            ]);

            Route::get('/edit/{name}', [
                'as' => 'role.edit',
                'uses' => 'RolesController@edit'
            ]);

            Route::put('/update/{name}', [
               'as' => 'role.update',
               'uses' => 'RolesController@update'
            ]);

            Route::delete('/delete/{name}', [
                'as' => 'role.destroy',
                'uses' => 'RolesController@destroy'
            ]);
        });
    }
);
