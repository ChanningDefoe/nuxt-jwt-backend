<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\MovieDB\APIHelper;

class MoviesController extends Controller
{   
    protected $helper;

    public function __construct()
    {
        $this->helper = new APIHelper;
    }

    /**
     * Trending
     * 
     * @return json
     */
    public function trending()
    {
        return response()->json($this->helper->trending());
    }   

    /**
     * Info 
     * 
     * @return json
     */
    public function info(Request $request)
    {
        return response()->json($this->helper->info($request->id));
    }

    /**
     * Category
     * 
     * @return json
     */
    public function category(Request $request)
    {
        return response()->json($this->helper->category($request->id, $request->page));
    }

    /**
     * Search
     * 
     * @param string query
     * @param string page
     * 
     * @return json
     */
    public function search(Request $request)
    {
        return response()->json($this->helper->search($request->search, $request->page));
    }

}
