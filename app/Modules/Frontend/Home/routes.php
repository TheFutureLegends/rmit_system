<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Modules\Frontend\Home\Controllers';
Route::group(
    ['module' => 'Home', 'namespace' => $namespace, 'middleware' => ['web']],
    function () {
        Route::get('/', [
            'as' => 'home.index',
            'uses' => 'HomeController@index',
        ]);
    }
);
