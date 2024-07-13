<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        
    }

    public function get_all_users () {
      $db = db_connect();
      $statement = $db->prepare("SELECT l.username, l.attempt, count(l.attempt) as number from log l
                                  join users u on u.username = l.username
                                  group by l.username, l.attempt
                                  order by l.username, l.attempt desc;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function get_users_last_attempts() {
      $db = db_connect();
      $statement = $db->prepare("select username, max(time) as time from log
                                      where attempt='good'
                                      group by username
                                      order by max(time) desc;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function authenticate($username, $password) {
        /*
         * if username and password good then
         * $this->auth = true;
         */
  		$username = strtolower($username);
  		$db = db_connect();
      $statement = $db->prepare("select * from users WHERE username = :name;");
      $statement->bindValue(':name', $username);
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      // print_r($rows['password']);

      // log all login attempts 
      $log_statement = $db->prepare("insert into log (username, attempt, time) values (?, ?, ?);");
      $login_time = date('Y-m-d H:i:s');
  
      //after 3 unsuccessful login attempts, lock the user out for 60 seconds 
      $bad_attempts = $this->count_bad_attempt($username);
      $last_bad_attempt = $this->get_last_bad_attempt_time($username);

      if ($bad_attempts >= 3 && strtotime($last_bad_attempt) > (time() - 60)) {
        // print_r("lock");
        return 'lock';
      } 
      
  		if (password_verify($password, $rows['password'])) {

          $_SESSION['auth'] = 1;
          $_SESSION['username'] = ucwords($username);
          $_SESSION['user_id'] = $rows['id'];
          unset($_SESSION['failedAuth']);
          
          $log_statement->execute([$username, 'good', $login_time]);

          if ($username == 'admin') {
            $_SESSION['admin'] = 1;
          }
        
    			header('Location: /home');
    			die;

  		} else {
  			if(isset($_SESSION['failedAuth'])) {
  				$_SESSION['failedAuth'] ++; //increment
  			} else {
  				$_SESSION['failedAuth'] = 1;
  			}

        $log_statement -> execute([$username, 'bad', $login_time]);
        
  			header('Location: /login');
  			die;
  		}
    }

  // create a new user
  public function create_user ($username, $password) {
    $db = db_connect();
    $statement = $db->prepare("insert into users (username, password) values (?, ?);");
    $new_user = $statement->execute([$username, $password]);
    
    header('Location: /home');
  }
  
  // check if username exists
  public function get_user_by_username ($username, $password) {
    $db = db_connect();
    $statement = $db->prepare("select * from users where username = ?;");
    $statement->execute([$username]);
    $rows = $statement->fetch(PDO::FETCH_ASSOC);

    // // if new user, then create
    // if (empty($rows)) {
    //   // hash password, then save to database
    //   $hash = password_hash($password, PASSWORD_DEFAULT);
    //   $this->create_user($username, $hash);
    // } else {
      // user exist
    
    return $rows;
    // }  
  }

  // check attempt
  public function count_bad_attempt ($username) {
    $db = db_connect();
    $statement = $db->prepare("select count(*) as count from log where username = ? and attempt = 'bad' and time >= date_sub(now(), interval 60 second);");
    $statement->execute([$username]);
    $rows = $statement->fetch(PDO::FETCH_ASSOC);
    return $rows['count'];
  }

  public function get_last_bad_attempt_time ($username) {
    $db = db_connect();
    $statement = $db->prepare("select time from log where username = ? and attempt = 'bad' order by time desc limit 1;");
    $statement->execute([$username]);
    $rows = $statement->fetch(PDO::FETCH_ASSOC);
    return $rows['time'];
  }

}
