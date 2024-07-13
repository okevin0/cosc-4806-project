<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-6">
                <h1>User's Reminders Count</h1>
                <table class="table table-striped table-hover" >
                      <thead>
                        <tr>
                          <th scope="col">Username</th>
                          <th scope="col">Total Reminders</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                    <tbody>
                        <?php  
                            // print user reminder summary
                            foreach ($data['num_reminders'] as $reminders) {

                                echo "<tr><td>".$reminders['username']."</td>
                                      <td>".$reminders['number']."</td>
                                      <td><a href='/reports/view_all_reminders/?id=".$reminders['id']."&name=".$reminders['username']."'>View All</a></td></tr>";

                                $username[] = $reminders['username'];
                                $reminders_num[] = $reminders['number'];
                            }
                               // print_r($_SESSION['user_id']);
                        ?>
                      </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <div style="margin-top: 80px;">
                    <canvas id="reminderChart"></canvas>
                </div>
                <script>
                    const labels = <?php echo json_encode($username); ?>;
                    const data = {
                      labels: labels,
                      datasets: [{
                        label: 'Reminders',
                        data: <?php echo json_encode($reminders_num); ?>,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)',
                            'rgba(201, 203, 208, 0.2)',
                            'rgba(201, 203, 209, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)',
                            'rgb(201, 203, 208)',
                            'rgb(201, 203, 209)'
                            ],
                        borderWidth: 1
                      }]
                    };

                    const config = {
                      type: 'line',
                      data: data,
                    };

                    var attepmtChart = new Chart(
                        document.getElementById('reminderChart'),config
                    );
                </script>
            </div>
        </div>
    </div>

</div>
    <?php require_once 'app/views/templates/footer.php' ?>
