<?php

class Rating {

    public function __construct() {

    }

    public function get_all_ratings_by_movie($movie) {
      $db = db_connect();
      $statement = $db->prepare("select * from rates where movie = ?;");
      $statement->execute([$movie]);
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function add_rating($movie, $user_id, $rating) {
      $db = db_connect();
      $statement = $db->prepare("insert into rates (user_id, movie, rating) values (?, ?, ?);");
      $statement->execute([$movie, $user_id, $rating]);
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

}