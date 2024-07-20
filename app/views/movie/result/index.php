<?php 

  if (!isset($_SESSION['auth'])) {
    require_once 'app/views/templates/headerPublic.php';
  } else {
    require_once 'app/views/templates/header.php';
  }

?>
<div class="modal-dialog-centered">
  <div class="container border bg-light p-3 bg-dark bg-opacity-25">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
              <h1>Search Movie</h1>
            </div>
        </div>
    </div>
    <div>
        <div>
          <form action="/movie/search" method="post">
              <div class="row g-1">
                <div class="col-sm-7">
                  <input type="text" class="form-control p-3 border bg-light" placeholder="Type Movie Name" name="movie_title">
                </div>
                <div class="col-sm">
                  <input type="number" class="form-control p-3 border bg-light" placeholder="Year" name="year">
                </div>
                <div class="col-sm-auto">
                  <button class="p-3 btn btn-primary" type="submit" >Search</button>
                </div>
              </div>
          </form>
      </div>
      <?php

        if((isset($_SESSION['search_empty']) && $_SESSION['search_empty'] == 1)) {
          echo "<br /><div class='alert alert-danger'> Please enter the movie title, it's can not be empty.</div>";
        }

        else if(isset($_SESSION['not_found']) && $_SESSION['not_found'] == 1 ) {
          echo "<br /><div class='alert alert-danger'>The movie title <i>".$data['movie']."</i> couldn't find, please check if it's right movie title you want search. or not right year.</div>";
        }

      ?>
    </div>
    <br />
    <div class="card mb-3 p-2" style="min-width: 540px;">
      <div class="row g-0">
        <div class="col-md-4 align-content-center text-center">
          <img src=<?php echo $data["movie"]["Poster"]; ?> class="img-fluid rounded-start" alt=<?php echo $data["movie"]["Title"]; ?> > 
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h1 class="card-title"><?php echo $data["movie"]["Title"]; ?></h1>
            <p class="card-text">
              <?php 
                echo "<p>".$data["movie"]["Plot"]."</p><hr />";
                echo  "<b>Director:</b> ".$data["movie"]["Director"].
                "<hr /><b>Writer:</b> ".$data["movie"]["Writer"].
                "<hr /><b>Actors:</b>".$data["movie"]["Actors"].
                "<hr />";
              ?>
              <table class="container">
                <tr>
                  <th>Country:</th><td><?php echo $data["movie"]["Country"]; ?></td>
                  <th>Language:</th><td><?php echo $data["movie"]["Language"]; ?></td>
                </tr>
                <tr>
                  <th>Released:</th><td><?php echo $data["movie"]["Released"]; ?></td>
                  <th>Length:</th><td><?php echo $data["movie"]["Runtime"]; ?></td>
                </tr>
                <tr>
                  <th>Type:</th><td><?php echo $data["movie"]["Type"]; ?></td>
                  <th>Genre:</th><td><?php echo $data["movie"]["Genre"]; ?></td>
                </tr>
                <tr>
                  <th>IMDB Rating:</th><td><?php echo $data["movie"]["imdbRating"]; ?></td>
                  <th>IMDB ID:</th><td><?php echo $data["movie"]["imdbID"]; ?></td>
                </tr>
              </table>
            </p>
          </div>
        </div>
        <div class="p-5 text-center">
          Your Rating: 
          <?php for($i = 1; $i <= 5; $i++) { ?>
          <a href="/movie/rating/?movie=<?php echo $data["movie"]["Title"]."&rating=".$i; ?>" class="btn btn-outline-warning">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
              <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
            </svg>
          <?php } ?>
          </a>
        
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
