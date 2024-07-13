<?php

class Create extends Controller {
// new controller fore create new account
    public function index() {		
	    $this->view('create/index');
    }

    public function verify(){
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];
      $confirm_password = $_REQUEST['confirm_password'];

      // check password match and need to meet a minimum security standard
      if ($password != $confirm_password) {
        $_SESSION['diff_password'] = 1;
      } 

      if (strlen($password) < 5) {
        $_SESSION['password_length'] = 1;
      }

      // call model to check if username exist, if not then create new account
     $check_user = $this->model('User');
     $is_exist_user = $check_user->get_user_by_username($username, $password); 
      // Check to see if the account name exists already
      if (!empty($is_exist_user)) {
        // if user exist, redirect to regiser page
        $_SESSION['user_exist'] = 1;
      }

      // if new user, then create
      if (empty($is_exist_user) && strlen($password) > 4 && $password == $confirm_password) {
        // hash password, then save to database
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $check_user->create_user($username, $hash);
      }

      $this->view('create/index');
    }
}
