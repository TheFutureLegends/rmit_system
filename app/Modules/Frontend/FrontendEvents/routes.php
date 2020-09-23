<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Modules\Frontend\FrontendEvents\Controllers';
Route::group(
    ['module' => 'FrontendEvents', 'namespace' => $namespace, 'middleware' => ['web']],
    function () {
        Route::get('/events', [
            'as' => 'events.frontend.index',
            'uses' => 'EventFrontendController@index',
        ]);

        Route::get('/event/{slug}', [
            'as' => 'events.frontend.show',
            'uses' => 'EventFrontendController@show',
        ]);
    }
);
