<?php

class Home extends Controller {

    public function index() {
      $user = $this->model('User');

      // only admin can see all users last attemp statu 
      if ($_SESSION['admin'] == 1) {
        $data = $user->get_users_last_attempts();
        $this->view('home/index', ['data' => $data]);
        die;
      }
			
	    $this->view('home/index');
	    die;
    }

}
