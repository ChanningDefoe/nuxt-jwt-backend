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

    // v1/user
    Route::prefix('user')->group(function () {
        // v1/user/addToWatchList
        Route::post('/addToWatchList', 'UserController@addToWatchList');
    });

    // v1/moviedb
    Route::prefix('moviedb')->group(function () {
        // v1/moviedb/movies
        Route::prefix('movies')->group(function () {
            // v1/moviedb/movies/trending
            Route::get('/trending', 'API\MoviesController@trending');
            // v1/moviedb/movies/info/{id}
            Route::get('/info/{id}', 'API\MoviesController@info');
            // v1/moviedb/movies/catgory/{id}
            Route::get('/category/{id}', 'API\MoviesController@category');
            // v1/moviedb/movies/search
            Route::get('/search', 'API\MoviesController@search');
        }); 
    });

});
