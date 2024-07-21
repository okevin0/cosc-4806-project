<?php

class Api {

    public function __construct() {

    }

    // Connect to OMDB, search a movie and return the result
    public function search_movie($movie_title) {
        $search_url = "https://www.omdbapi.com/?apikey=".$_ENV['omdb_key']."&t=".$movie_title."&plot=full";

        $response = file_get_contents($search_url);
        $movie_obj = json_decode($response);
        $movie = (array)$movie_obj;

        return $movie;
    }

    // Connect to Gemini, generate a movie review
    public function ai_review($movie_title) {
          
        // Gemini API Key
        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=".$_ENV['Gemini'];

        $data = array(
            "contents" => array(
                "role" => "user",
                 "parts" => array(
                     "text" => "Please give a movie review from someone who rate more then 4 start for ".$movie_title
                 )             
            )
        );

        $json_data = json_encode($data);

        //initialize curl and set curl options
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if(curl_errno($ch)){
            echo 'Curl Error:' . curl_error($ch);
        }

        $response_obj = json_decode($response);
        // get review text
        $review = $response_obj->candidates[0]->content->parts[0]->text;

        return $review;
    }
}
?>