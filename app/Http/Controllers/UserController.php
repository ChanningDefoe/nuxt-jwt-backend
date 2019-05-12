<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\WatchList;

class UserController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Add Movie to Watch List
     * 
     * @return json
     */
    public function addToWatchList(Request $request)
    {
        $new_watch = WatchList::firstOrCreate([
            'user_id' => auth()->user()->id,
            'movie_id' => $request->movie_id ], 
        [
            'imdb_movie_id' => $request->imdb_movie_id,
            'movie_title' => $request->movie_title,
            'movie_image_path' => $request->movie_image_path
        ]);

        return response()->json($new_watch);
    }
}
