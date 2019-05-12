<?php

namespace App\Helpers\MovieDB;

use GuzzleHttp\Client;

class APIHelper {

    public $url;
    protected $apikey;

    public function __construct()
    {
        $this->url = config('moviedb.route');
        $this->apikey = config('moviedb.key');
    }

    /**
     * Guzzle Get Requests
     * 
     * @param string $url
     * @param array $additionalparams
     * 
     * @return array
     */
    protected function guzzleGet(string $url, $additionalparams = [])
    {
        
        $client = new Client;
        $response = $client->request('GET', $url, [
            'query' => array_merge(['api_key' => $this->apikey], $additionalparams),
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Get Trending
     * 
     * DOCUMENTATION: https://developers.themoviedb.org/3/trending/get-trending
     * 
     * @param string media_type
     * @param string time_window
     * 
     * @return array
     */
    public function trending(string $media_type = 'movie', string $time_window = 'day')
    {
        $url = $this->url . '/trending' . '/' . $media_type . '/' . $time_window;
        return $this->guzzleGet($url);
    }

    /**
     * Get Movie Info
     * 
     * @param string id | ID of the movie from TMDB
     * 
     * @return array
     */
    public function info(string $id)
    {
        $url = $this->url . '/movie' . '/' . $id;
        return $this->guzzleGet($url);
    }

    /**
     * Get Movies in category
     * Gets them by descending popularity
     * 
     * @param string $id | category id from TMDB
     * @param string $page | page to query
     * 
     * @return response array
     */
    public function category(string $id, $page = null)
    {
        $url = $this->url . '/discover/movie';
        $params = array(
            'language' => 'en-us',
            'sortby' => 'popularity.desc',
            'include_adult' => false,
            'with_genres' => $id
        );
        // Also add page if it exists
        // Idk I might add pagination later
        if ($page){
            $params['page'] = $page;
        }
        return $this->guzzleGet($url, $params);
    }

}
