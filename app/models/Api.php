<?php

class Api {

    public function __construct() {

    }

    // Connect to OMDB, search a movie and return the result
    public function search_movie($movie_title,$year) {
        $search_url = "https://www.omdbapi.com/?apikey=".$_ENV['omdb_key']."&t=".$movie_title."&y=".$year."&plot=full";

        $response = file_get_contents($search_url);
        $movie_obj = json_decode($response);
        $movie = (array)$movie_obj;

        return $movie;
    }
}
?>