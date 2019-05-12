<?php

return [

    'route' => 'https://api.themoviedb.org/3',
    
    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | Private API Key from themoviedb
    |
    | Link: https://www.themoviedb.org/settings/api
    |
    */

    'key' => env('MOVIEDB_KEY', null),

    'access_token' => env('MOVIEDB_ACCESS_TOKEN', null)

];
