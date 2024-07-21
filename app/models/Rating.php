<?php

class Rating {

    public function __construct() {

    }

    public function get_all_ratings_by_movie($movie) {
      $db = db_connect();
      $statement = $db->prepare("select username,rating,create_date from rates r 
                                 join users u on u.id = r.user_id 
                                 where movie = ?
                                 order by create_date desc;");
      $statement->execute([$movie]);
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    // add movie rating to DB. if user already add rating, then update rating
    public function add_rating($movie, $user_id, $rating) {
      $db = db_connect();
      $statement = $db->prepare("insert into rates (user_id, movie, rating) values (?, ?, ?) 
                                  on duplicate key update rating = values(rating);");
      $statement->execute([$movie, $user_id, $rating]);
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

}