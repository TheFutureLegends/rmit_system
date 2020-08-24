<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Modules\Backend\Dashboard\Controllers';
Route::group(
    ['module' => 'Dashboard','prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web', 'auth']],
    function () {
        Route::get('/', [
            'as' => 'dashboard.index',
            'uses' => 'DashboardController@index',
        ]);

        Route::get('/dataTable/language', [
            'as' => 'dashboard.dataTable.language',
            'uses' => 'DashboardController@dataTable_language',
        ]);
    }
);
