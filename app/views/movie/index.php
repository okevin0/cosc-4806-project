<?php require_once 'app/views/templates/headerPublic.php'?>
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
          <?php
            // only print when lock user
            if(isset($_SESSION['lock']) && $_SESSION['lock'] == 1 ) {
              echo "<div class='alert alert-danger'> You accound is locked, please try after 60 seconds.</div>";
            }

            // only print when wrong username/password
            if(isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] > 0 ) {
              echo "<div class='alert alert-danger'>Your username or password is not right, please try again.</div>";
            }
          ?>
          <form action="/movie/search" method="post">
              <div class="row g-1">
                <div class="col-sm-7">
                  <input type="search" class="form-control p-3 border bg-light" placeholder="Type Movie Name" name="search">
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
    </div>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
