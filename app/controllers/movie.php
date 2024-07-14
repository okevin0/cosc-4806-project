<?php

class Movie extends Controller {

    public function index() {
    
      $this->view('movie/index');
      die;
    }

}
