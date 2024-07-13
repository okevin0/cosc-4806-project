<?php

// do not allow a non-admin user and non-logged-in users to view the page
class Reports extends Controller {
  
    public function index() {
      // $all_users = $this->model('User');
      header('Location: /home');
      die;
    }
  
    public function allusers() {
      
      if (!isset($_SESSION['admin'])) {
        header('Location: /home');
      }
      
      $all_users = $this->model('User');
      $list_of_users = $all_users->get_all_users();
      $this->view('reports/allusers/index', ['list_of_users' => $list_of_users]);
      die;
    }

    // list user's all reminders number and who has most reminder in first place. for admin only
    public function count_reminders(){
      
      if (!isset($_SESSION['admin'])) {
        header('Location: /home');
      }
      
      $reminder = $this->model('Reminder');
      $num_of_reminders = $reminder->get_user_reminders_count();
      $this->view('reports/countreminders/index', ['num_reminders' => $num_of_reminders]);
      die;
    }

    // view user's all reminder
    public function view_all_reminders() {
      
      if (!isset($_SESSION['admin'])) {
        header('Location: /home');
      }

      $user_id = $_REQUEST['id'];
      // print_r($_REQUEST['id']);
      // print_r($_REQUEST['name']);
      $reminder = $this->model('Reminder');
      $list_of_reminders = $reminder->get_all_reminders_by_userid($user_id);

      $this->view('reminders/index', ['reminders' => $list_of_reminders]);
    }
}
