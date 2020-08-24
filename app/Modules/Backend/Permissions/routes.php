<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Modules\Backend\Permissions\Controllers';
Route::group(
    ['module' => 'Permissions','prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web', 'auth' ,'role:super-admin']],
    function () {
        Route::group(['prefix' => 'permissions'], function () {
            Route::get('/', [
                'as' => 'permissions.index',
                'uses' => 'PermissionsController@index'
            ]);

            Route::post('/dataTable', [
                'as' => 'permissions.dataTable',
                'uses' => 'PermissionsController@dataTable'
            ]);

            Route::post('/loadOptions', [
                'as' => 'permissions.loadOptions',
                'uses' => 'PermissionsController@loadOptions'
            ]);
        });

        Route::group(['prefix' => 'permission'], function () {
            Route::get('/create', [
                'as' => 'permission.create',
                'uses' => 'PermissionsController@create'
            ]);

            Route::post('/store', [
                'as' => 'permission.store',
                'uses' => 'PermissionsController@store'
            ]);

            Route::get('/edit/{name}', [
                'as' => 'permission.edit',
                'uses' => 'PermissionsController@edit'
            ]);

            Route::put('/update/{name}', [
               'as' => 'permission.update',
               'uses' => 'PermissionsController@update'
            ]);

            // Route::delete('/delete/{name}', [
            //     'as' => 'permission.destroy',
            //     'uses' => 'PermissionsController@destroy'
            // ]);
        });
    }
);
