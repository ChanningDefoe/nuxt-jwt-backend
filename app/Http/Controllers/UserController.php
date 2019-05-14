<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\WatchList;
use App\Http\Resources\WatchList as WatchListResource;

class UserController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get watch list for authenticated user
     * 
     */
    public function getWatchList(Request $request)
    {
        return response()->json(
            auth()->user()->watchListMovies()
            ->orderBy('created_at', 'desc')
            ->paginate(8)
        );
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
