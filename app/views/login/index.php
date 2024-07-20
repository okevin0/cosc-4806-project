<?php 
	require_once 'app/views/templates/headerPublic.php';
	session_destroy();
?>
	<div class="align-items-center d-flex justify-content-center" style="min-height: 70vh !important;">
	<div>
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>You are not logged in</h1>
            </div>
        </div>
    </div>

		<div class="row">
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
					</div>
					<form action="/login/verify" method="post">
					<fieldset>
						<div class="d-grid gap-3">
							<div class="form-group p-2 bg-light border">
								<!-- <label for="username">Username</label> -->
								<input required type="text" class="form-control" name="username" placeholder="Username">
							</div>
							<div class="form-group p-2 bg-light border">
								<!-- <label for="password">Password</label> -->
								<input required type="password" class="form-control" name="password" placeholder="Password">
							</div>
							
					    <button type="submit" class="btn btn-primary " style="width: 100%;">Login</button>
						</div>
					</fieldset>
					</form> 
					</br>
					<a href="/create">Create New Account</a>
			</div>
		</div>
	</div>
</div>
							
<?php require_once 'app/views/templates/footer.php' ?>
