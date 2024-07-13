<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1> <?php if($_REQUEST['name']) { print_r($_REQUEST['name']."'s "); }?>Reminders</h1>
                <p class="lead">Today is <?= date("F jS, Y"); ?> 
                    <?php if(!$_REQUEST['name']) {?>   
                            <a class="btn btn-primary" href="/reminders/create">Create Reminder</a>
                    <?php } ?> </p>
                <table class="table table-striped table-hover" >
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Reminder</th>
                          <th scope="col">Completed</th>
                          <th scope="col">Create At</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                    <tbody>
                        <?php  
                            // print reaminders, update and delete a reminder
                            $num = 1;
                            foreach ($data['reminders'] as $reminder) {
                        
                                if ($reminder['completed'] == 1) { 
                                    echo "<tr class='bg-success bg-opacity-25'>";
                                } else {
                                    echo "<tr>";
                                }
                        
                                echo "<td>".$num."</td>
                                      <td>".$reminder['subject']."</td>";
                                if ($reminder['completed'] == 1) { ?>
                                    <td><a href="/reminders/is_completed/<?php echo $reminder['id']; ?>" class="btn btn-success">Completed</a></td>
                                <?php } else { ?>
                                    <td><a href="/reminders/is_completed/<?php echo $reminder['id']; ?>"class="btn btn-warning">Uncomplete</a></td>     
                                <?php } 
                                echo"<td>".$reminder['created_at']."</td>";?>
                                <td><a href="/reminders/update/<?php echo $reminder['id']; ?>"class="btn btn-danger">Update</a></td>
                                <td><a href="/reminders/delete/<?php echo $reminder['id']; ?>" class="btn btn-danger">Delete</a></td>
                            </tr> 
                        <?php
                                $num++;
                            }
                               // print_r($_SESSION['user_id']);
                        ?>
                      </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
    <?php require_once 'app/views/templates/footer.php' ?>
