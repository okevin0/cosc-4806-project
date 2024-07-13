<?php

class Reminder {

    public function __construct() {

    }

    public function get_all_reminders () {
      $db = db_connect();
      $statement = $db->prepare("select * from reminders;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function get_user_reminders_count () {
      $db = db_connect();
      $statement = $db->prepare("select u.id, u.username, count(r.subject) as number FROM users u
                                  left join reminders r on u.id= r.user_id
                                  group by u.id, u.username
                                  order by count(r.subject) desc;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }
  
  // Create a reminder, view reminders (read), update existing reminders, and delete reminders
    public function get_all_reminders_by_userid ($user_id) {
      $db = db_connect();
      $statement = $db->prepare("select * from reminders where user_id = ?;");
      $statement->execute([$user_id]);
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function get_reminder_by_id ($reminder_id) {
      $db = db_connect();
      $statement = $db->prepare("select * from reminders where id = ?;");
      $statement->execute([$reminder_id]);
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }
  
    public function create_reminder ($user_id, $subject, $created_at) {
      $db = db_connect();
      $statement = $db->prepare("insert into reminders (user_id, subject, created_at) values (?, ?, ?);");
      $new_user = $statement->execute([$user_id, $subject, $created_at]);

      header('Location: /reminders');
    }
  
    public function update_reminder ($user_id, $reminder_id, $subject, $is_completed) {
      $db = db_connect();
      // print_r($reminder_id); die;
      $statement = $db->prepare("update reminders set subject = ?, completed = ? where id = ? and user_id = ?;");
      $statement->execute([$subject, $is_completed, $reminder_id, $user_id]);
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }
  
    public function delete_reminder ($user_id, $reminder_id) {
      $db = db_connect();
      $statement = $db->prepare("delete from reminders where id = ? and user_id = ?;");
      $statement->execute([$reminder_id, $user_id]);
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }
  
    public function completed ($user_id, $reminder_id, $completed) {
      $db = db_connect();
      $statement = $db->prepare("update reminders set completed = ? where id = ? and user_id = ?;");
      $statement->execute([$completed, $reminder_id, $user_id]);
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }
}
?>
