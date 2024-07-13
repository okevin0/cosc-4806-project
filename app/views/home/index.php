<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Hey</h1>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>
<?php if ($_SESSION['admin'] == 1) { ?>
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
    <?php require_once 'app/views/templates/footer.php' ?>
