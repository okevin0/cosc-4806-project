<?php

class Movie extends Controller {

    // define global variable
    private  $movie_review = "";
  
    public function index() {
      $this->view('movie/index');
      die;
    }

    // Allow someone (who doesn’t need to be logged in but it is okay if they are) to search for a movie 
    public function search(){
      global $movie_review;
      
      if($_REQUEST['movie'] != ''){
        $_SESSION['search_empty'] = 0;
        $movie_tilte = $_REQUEST['movie'];
      } else {
        $movie_tilte = $_REQUEST['movie_title'];
      }

      if($movie_tilte == "") {
        $_SESSION['search_empty'] = 1;
        $this->view('movie/result/index', ['movie' => '']);
        die;
      }

      // connect to OMDB
      $search_movie = $this->model('Api');
      $movie_obj = $search_movie->search_movie($movie_tilte);

      if($movie_obj['Response'] == 'False') {
        $_SESSION['not_found'] = 1;
        $this->view('movie/result/index', ['movie' => $movie_tilte]);
        die;
      }

      // get the movie rates
      $list_of_rating = $this->view_all_ratings($movie_tilte);

      $this->view('movie/result/index', ['movie' => $movie_obj, 'rating' => $list_of_rating, 'review' => $movie_review]);
    }

    // load movie rating into DB
    public function rating(){
      if (!isset($_SESSION['auth'])) {
        $_SESSION['unauth_rating'] = 1;
        $this->search();
        die;
      }
      
      $movie = $_REQUEST['movie'];
      $rating = $_REQUEST['rating'];
      // echo $movie." ".$rating."user=".$_SESSION['user_id'];

      $this->model('Rating')->add_rating($_SESSION['user_id'], $movie, $rating);

      $this->search();
    }

    public function view_all_ratings($movie) {
      $movie_rating = $this->model('Rating');
      $list_of_rating = $movie_rating->get_all_ratings_by_movie($movie);

      return $list_of_rating;
    }

    // user get movie review from AI, and return to search result page
    public function review() {
      global $movie_review;
      
      $movie_title = $_REQUEST['movie'];
      $movie_review = $this->model('Api')->ai_review($movie_title);
      
      // format review
      $movie_review = preg_replace('/\*\*(.*?)\*\*/', '<h5>$1</h5>', $movie_review);

      $this->search();
    }

}
