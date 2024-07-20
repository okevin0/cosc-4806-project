<?php

class Movie extends Controller {

    public function index() {
      $this->view('movie/index');
      die;
    }

    // Allow someone (who doesn’t need to be logged in but it is okay if they are) to search for a movie 
    public function search(){

      if($_REQUEST['movie'] != ''){
        $_SESSION['search_empty'] = 0;
        $movie_tilte = $_REQUEST['movie'];
      } else {
        $movie_tilte = $_REQUEST['movie_title'];
      }
      
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

    // load movie rating into DB
    public function rating(){

      $movie = $_REQUEST['movie'];
      $rating = $_REQUEST['rating'];
      // echo $movie." ".$rating."user=".$_SESSION['user_id'];

      $this->model('Rating')->add_rating($_SESSION['user_id'], $movie, $rating);

      $this->search();
    }

}
