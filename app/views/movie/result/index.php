<?php require_once 'app/views/templates/headerPublic.php'?>
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

        if(isset($_SESSION['search_empty']) && $_SESSION['search_empty'] == 1 ) {
          echo "<br /><div class='alert alert-danger'> Please enter the movie title, it's can not be empty.</div>";
        }

        if(isset($_SESSION['not_found']) && $_SESSION['not_found'] == 1 ) {
          echo "<br /><div class='alert alert-danger'>The movie title <i>".$data['movie']."</i> couldn't find, please check if it's right movie title you want search. or not right year.</div>";
        }

        session_destroy();
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
      </div>
    </div>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
