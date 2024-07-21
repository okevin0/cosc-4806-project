<?php require_once 'app/views/templates/header.php'; ?>
    <div class="container">
      <div class="row justify-content-center">
        <?php 
          if ($_SESSION['admin'] == 1) {
            echo '<div class="col-9">';
          } else {
            echo '<div class="col-12">';
          }
          
          require_once 'app/views/movie/index.php'; 
          
          ?>
        </div>
        <div class="col-3">
            <?php 
                if ($_SESSION['admin'] == 1) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1>User's Last Attempt</h1>
                        <table class="table table-striped table-hover" >
                              <thead>
                                <tr>
                                  <th scope="col">Username</th>
                                  <th scope="col">Last Attempt</th>
                                </tr>
                              </thead>
                            <tbody>
                                <?php  
                                    foreach ($data['data'] as $user) {
    
                                        echo "<tr><td>".$user['username']."</td>
                                              <td>".$user['time']."</td></tr>";
                                    }
                                ?>
                              </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php require_once 'app/views/templates/footer.php' ?>
