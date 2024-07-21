<?php 
if (!isset($_SESSION['auth'])) {
  // print_r("You are not logged in");
  require_once 'app/views/templates/headerPublic.php';
} else {
  require_once 'app/views/templates/header.php';
}
?>
  <div class="modal-dialog-centered" style="min-height: 70vh !important;">
  <div class="container border bg-light p-5 bg-dark bg-opacity-25">
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
                <div class="col-sm-10">
                  <input type="text" class="form-control p-3 border bg-light" placeholder="Type Movie Name" name="movie_title">
                </div>
                <div class="col-sm-auto">
                  <button class="p-3 btn btn-primary" type="submit" >Search</button>
                </div>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
