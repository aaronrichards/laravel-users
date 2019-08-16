<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// APP Routes Below
Route::group(['middleware' => 'web', 'namespace' => 'aaronrichards\laravelusers\app\Http\Controllers'], function () {
    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
    ]);
});
