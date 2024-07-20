<?php
if (!isset($_SESSION['auth'])) {
    header('Location: /movie');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="icon" href="/favicon.png">
        <title>COSC4806</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #9db6c8;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">COSC4806</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about">About Me</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reminders
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/reminders">All Reminders</a></li>
            <li><a class="dropdown-item" href="/reminders/create">Create Reminder</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/movie">Movie Search</a>
        </li>
        <?php if ($_SESSION['admin'] == 1) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reports
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/reports/allusers">All Users</a></li>
            <li><a class="dropdown-item" href="/reports/count_reminders">User's Reminder Count</a></li>
          </ul>
        </li>
        <?php } ?>  
        <!-- <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li> -->
      </ul>

      <ul class="navbar-nav me-5 mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome, <?php print_r($_SESSION['username']); ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a  class="dropdown-item" href="/logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php if( $_SESSION['controller'] != 'home' ) { ?>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= ucwords($_SESSION['controller']) ?></li>
          </ol>
        </nav>
    </div>
  </div>
</div>
<?php } ?>