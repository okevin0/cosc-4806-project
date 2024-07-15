<?php

class Movie extends Controller {

    public function index() {
    
      $this->view('movie/index');
      die;
    }

    // Allow someone (who doesn’t need to be logged in but it is okay if they are) to search for a movie 
    public function search(){
      $movie_tilte = $_REQUEST['movie_title'];
      $year = $_REQUEST['year'];

      if($movie_tilte == "") {
         $_SESSION['search_empty'] = 1;
      }
      // connect to OMDB
      $search_movie = $this->model('Api');
      $movie_obj = $search_movie->search_movie($movie_tilte, $year);

      if($movie_tilte == "") {
         $_SESSION['search_empty'] = 1;
      }

      if($movie_obj['Response']) {
        $_SESSION['not_found'] = 1;
      }

      print_r($movie_obj);

     
      $this->view('movie/search', ['movie' => $movie_obj]);
    }

}
