<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Modules\Frontend\Events\Controllers';
Route::group(
    ['module' => 'Events', 'namespace' => $namespace, 'middleware' => ['web']],
    function () {
        Route::get('/events', [
            'as' => 'events.frontend.index',
            'uses' => 'EventController@index',
        ]);

        Route::get('/event/{slug}', [
            'as' => 'events.frontend.show',
            'uses' => 'EventController@show',
        ]);
    }
);
