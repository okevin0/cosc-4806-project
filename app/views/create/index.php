<?php require_once 'app/views/templates/headerPublic.php'?>
<div class="align-items-center d-flex justify-content-center" style="min-height: 70vh !important;">
 <div>
    <h1>Create New Account</h1>
    <div>
    <?php
      // only print when new user exist
      if(isset($_SESSION['user_exist']) && $_SESSION['user_exist'] > 0 ) {
        echo "<div class='alert alert-danger'>The account already exist.</div>";
      }

      // only print when passwords not match
      if(isset($_SESSION['diff_password']) && $_SESSION['diff_password'] > 0 ) {
        echo "<div class='alert alert-danger'>passwords not matche.</div>";
      }

      // only print when password length is less than 5
      if(isset($_SESSION['password_length']) && $_SESSION['password_length'] > 0 ) {
        echo "<div class='alert alert-danger'>Passwords length should be at least 5 characters.</div>";
      }

      // delete session 
      session_destroy();
    ?>
    </div>
    <form action="/create/verify" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="form-group">
        <label for="confirm password">Confirm Password:</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm password">
      </div>
      <br />
      <input type="submit" value="Submit" class="btn btn-primary" style="width: 100%;" > 
    </form> 
   </div>
  </div>
<br />
  <?php require_once 'app/views/templates/footer.php' ?>