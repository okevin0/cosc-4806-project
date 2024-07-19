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
        $this->view('movie/result/index', ['movie' => '']);
        die;
      }

      // connect to OMDB
      $search_movie = $this->model('Api');
      $movie_obj = $search_movie->search_movie($movie_tilte, $year);

      if($movie_obj['Response'] == 'False') {
        $_SESSION['not_found'] = 1;
        $this->view('movie/result/index', ['movie' => $movie_tilte]);
        die;
      }

      $this->view('movie/result/index', ['movie' => $movie_obj]);
    }

}
