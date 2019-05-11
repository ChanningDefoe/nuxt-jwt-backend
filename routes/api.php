<?php
// v1
Route::prefix('v1')->group(function () {
    // v1/auth
    Route::prefix('auth')->group(function () {
        // v1/auth/register
        Route::post('/register', 'AuthController@register');
        // v1/auth/login
        Route::post('/login', 'AuthController@login');
        // v1/auth/logout
        Route::post('/logout', 'AuthController@logout');
        // v1/auth/user
        Route::get('/user', 'AuthController@user');
    });
    
});
