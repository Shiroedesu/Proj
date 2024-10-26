<?php
include("config.php");
session_start();

$admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location:index.php');
    }

 // FORM 1 CHART
error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Database connection
$host = 'localhost'; // your database host
$db   = 'his'; // your database name
$user = 'root'; // your database username
$pass = ''; // your database password

       try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch data from the `patients` table
        $stmt = $pdo->query("SELECT `form1` FROM patients");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize arrays to hold values
        $arrays = [];

        // Split each row's values into an array and merge them into $arrays
        foreach ($rows as $row) {
            $arrays[] = explode(',', $row['form1']); // Split values by comma
        }

        // Flatten the arrays into a single array of all items
        $allItems = array_merge(...$arrays);

        // Prepare data for the chart by counting occurrences of each unique item
        $counts = array_count_values($allItems);

        // Chart data: labels are unique items, data is their respective count
        $chartData = [
            'labels' => array_keys($counts),
            'data' => array_values($counts),
        ];

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }

        // Function to generate random color
        function generateRandomColor() {
            $r = rand(0, 255);
            $g = rand(0, 255);
            $b = rand(0, 255);
            return "rgba($r, $g, $b, 0.6)";
        }

// Database connection for form2
    try {
        $pdo2 = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch data from the `patients` table
        $stmt2 = $pdo2->query("SELECT `form2` FROM patients");
        $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        // Initialize arrays to hold values
        $arrays2 = [];

        // Split each row's values into an array and merge them into $arrays
        foreach ($rows2 as $row2) {
            $arrays2[] = explode(',', $row2['form2']); // Split values by comma
        }

        // Flatten the arrays into a single array of all items
        $allItems2 = array_merge(...$arrays2);

        // Prepare data for the chart by counting occurrences of each unique item
        $counts2 = array_count_values($allItems2);

        // Chart data: labels are unique items, data is their respective count
        $chartData2 = [
            'labels' => array_keys($counts2),
            'data' => array_values($counts2),
        ];

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }

        // Function to generate random color
        function generateRandomColor2() {
            $r = rand(0, 255);
            $g = rand(0, 255);
            $b = rand(0, 255);
            return "rgba($r, $g, $b, 0.6)";
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>health information system</title>
        <!-- ======= Styles ====== -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" href="aaa.css">
        <script src="js.js"></script>
        <script src="js3.js"></script>
        <script src="script.js"></script>
    </head>

    <body>
        <?php
                $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$admin_id'") or die('query failed');
                if(mysqli_num_rows($select) > 0){
                  $fetch = mysqli_fetch_assoc($select);
                }
            ?>
        <!-- =============== Header ================ -->
        <header class="header">

            <img class="img" src="assets/imgs/flogo.png"><a
                class="health"><strong>Health </strong>Data Management System </a>

            <div id="menu-btn" class="fas fa-bars"></div>

            <div class="topbar">

                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>

                </div>

                <div class="user">
                        <a href="admin_profile_logged_in.php">
                            <?php
                                 if ($fetch['image'] == ''){
                                      echo '<img src="uploaded_img/pic2.jpg">';
                                    }else {
                                      echo '<img src= "uploaded_img/'.$fetch['image'].'">';
                                    }
                            ?>
                        </a>
                </div>
            </div>
        </header>
        <!-- =============== Navigation ================ -->
        <div class="container">
            <div class="navigation">
                <ul>
                    <li>
                    </li>
                    <li>
                        <a href="dashboard.php" class="dashboard">
                            <span class="icon">
                                <ion-icon name="home-outline" style="color: #227C67;"></ion-icon>
                            </span>
                            <span class="title" style="color: #227C67;">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="Records_now.php">
                            <span class="icon">
                                <ion-icon name="receipt-outline"></ion-icon>
                            </span>
                            <span class="title">Records</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_issuance.php">
                            <span class="icon">
                                <ion-icon name="print-outline"></ion-icon>
                            </span>
                            <span class="title">Issuance</span>
                        </a>
                    </li>
                    <li>
                        <a href="user.php">
                            <span class="icon">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                            <span class="title">User</span>
                        </a>
                    </li>
                    <li>
                        <a id="triggerBtn" onclick="showModal()">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- ========================= Main ==================== -->
            <div class="main"> 
                    <div id="logoutPrompt" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <p>Do you want to log out?</p>
                            <button onclick="logout()">Yes</button>
                            <button onclick="closeModal()">No</button>
                        </div>
                    </div>
                <!-- ======================= dashboard ================== -->
                <section class="dashboard" id="dashboard">
                    <h1 class="heading"> <span>dashboard</span></h1>
                    <div class="row">
                <div class="cardBox">
                    <a class="card" href="#appoint">
                        <div>
                            <div class="numbers">
                                <?php 
                                    $events_total_query = "SELECT * FROM events";
                                    $events_total_query_run = mysqli_query($conn,$events_total_query);

                                    if ($events_total = mysqli_num_rows($events_total_query_run)) {
                                        echo "$events_total";
                                    }else {
                                        echo "no data";
                                    }
                                ?>
                        </div>
                            <div class="cardName">appointment</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="receipt-outline"></ion-icon>
                        </div>
                    </a>
                    <a class="card" href="#log">
                        <div>
                            <div class="numbers">
                                <?php 
                                    $start = 0;
                                    $end = 24;
                                    $events_total_query = "SELECT * FROM users WHERE time_in BETWEEN DATE(NOW() + INTERVAL $start DAY)
  AND DATE(NOW() + INTERVAL $end DAY) ";
                                    $events_total_query_run = mysqli_query($conn,$events_total_query);

                                    if ($events_total = mysqli_num_rows($events_total_query_run)) {
                                        echo "$events_total";
                                    }else {
                                        echo "no data";
                                    }
                                ?>
                            </div>
                            <div class="cardName">Recent log in</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="people-outline"></ion-icon>
                        </div>
                    </a>
                    <a class="card" href="#details">
                        <div>
                            <div class="numbers">
                                <?php 
                                    $events_total_query = "SELECT * FROM users WHERE status = 'pending'";
                                    $events_total_query_run = mysqli_query($conn,$events_total_query);

                                    if ($events_total = mysqli_num_rows($events_total_query_run)) {
                                        echo "$events_total";
                                    }else {
                                        echo "no data";
                                    }
                                ?>
                            </div>
                            <div class="cardName">User Validation</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="person-add-outline"></ion-icon>
                        </div>
                    </a>
                    <a class="card" href="#monitor">
                        <div>
                            <div class="numbers">
                                <?php 
                                    $patients_total_query = "SELECT * FROM patients";
                                    $patients_total_query_run = mysqli_query($conn,$patients_total_query);

                                    if ($patients_total = mysqli_num_rows($patients_total_query_run)) {
                                        echo "$patients_total";
                                    }else {
                                        echo "no data";
                                    }
                                ?>
                            </div>
                            <div class="cardName">Total Patient</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="body-outline"></ion-icon>
                        </div>
                    </a>
                   
               
            </div>
                <!-- ================ Add Charts JS ================= -->
                <h1 class="heading"> <span>ANALYSIS</span></h1>
                <div class="chartsBx">
                    <div class="chart">
                        <canvas id="form1" height="250"></canvas>
                    </div>
                    <div class="chart">
                        <canvas id="form2" height="120"></canvas>
                    </div>
                </div>
            </div>
                </section>
                           <!-- dashboard section end   -->

                <!-- appointmenting section starts   -->
                    <h1 class="heading"> <span>appointment</span> now </h1>
                <section class="appoint" id="appoint">
                     <div class="contianer">
                        <div class="calendar">
                            <div class="calendar-header">
                                <span class="month-picker" id="month-picker">
                                    May </span>
                                <div class="year-picker" id="year-picker">
                                    <span class="year-change" id="pre-year">
                                        <pre><</pre>
                                    </span>
                                    <span id="year">2020 </span>
                                    <span class="year-change" id="next-year">
                                        <pre>></pre>
                                    </span>
                                </div>
                            </div>

                            <div class="calendar-body">
                                <div class="calendar-week-days">
                                    <div>Sun</div>
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                </div>
                                <div class="calendar-days">
                                </div>
                            </div>
                            <div class="calendar-footer">
                            </div>
                            <div class="month-list"></div>
                        </div>
                        <!-- =========== Scripts =========  -->
                        <script src="assets/js/calendar.js"></script>
                    </div>
                    <div class="contianer">
                        <div class="calendar-eve">
                            <div class="calendar-body">
                                <div class="show-events">
                                    <?php
                                        if (isset($_GET['id'])){
                                            $id=$_GET['id'];
                                            $delete = mysqli_query($conn, "DELETE FROM events WHERE id = '$id'");
                                            echo '<script type = "text/javascript">';
                                            echo 'alert("Event Deleted!");';
                                            echo 'window.location.href = "dashboard.php"';
                                            echo '</script>';
                                        }

                                        $select_query ="SELECT * FROM `events`" or die('query failed');
                                        $result = mysqli_query($conn,$select_query);
                                    ?>
                                    <div>
                                        <h3> Appointments / Events   </h3>
                                        <div class="list">
                                            <?php
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    echo "
                                                    <ul>
                                                    <li>
                                                        <h4>".$row['title']."<a href= '?id=".$row['id']."'>&times;</a></h4>
                                                        <p>".$row['start_date']."</p>
                                                        <p>-</p>
                                                        <p>".$row['end_date']."</p>
                                                    </li>
                                                </ul>
                                                ";
                                                 }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- =========== Scripts =========  -->
                        <script src="assets/js/calendar.js"></script>
                    </div>
                   <div class="contianer">
                    <?php 
                        include('config.php');
                        if(isset($_REQUEST['save-event']))
                        {
                          $title = $_REQUEST['title'];
                          $start_date = $_REQUEST['start_date'];
                          $end_date = $_REQUEST['end_date'];

                          $insert_query = mysqli_query($conn, "INSERT INTO events SET title='$title', start_date='$start_date', end_date='$end_date'");
                          if($insert_query)
                          {
                            echo '<script type = "text/javascript">';
                            echo 'alert("Event Created!");';
                            echo 'window.location.href = "dashboard.php"';
                            echo '</script>';
                          }
                          else
                          {
                            echo '<script type = "text/javascript">';
                            echo 'alert("Event not created!");';
                            echo 'window.location.href = "dashboard.php"';
                            echo '</script>';
                          }
                        }
                        ?>
                            <div class="events">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <h3>Create Appointment/Event</h3>
                                        <div>
                                            <p>Title</p>
                                            <input type="text" name="title" placeholder="Title" autocomplete="off" required>
                                        </div>
                                        <div>
                                            <p>Date start</p>
                                            <input type="datetime-local" name="start_date" required>
                                        </div>
                                        <div>
                                            <p>Date End</p>
                                            <input type="datetime-local" name="end_date" required>
                                        </div>
                                        <input type="submit" name="save-event" value="Create">
                                        <p class="error">
                                            <?php if(!empty($msg)){ echo $msg; } ?>
                                        </p>
                                        <p class="succ">
                                            <?php if(!empty($msgSuc)){ echo $msgSuc; } ?>
                                        </p>
                                    </form>
                            </div>
                        </div>
                       
                    <!-- =========== Scripts =========  -->
                    <script src="assets/js/calendar.js"></script>

                </section>
                <!-- appointmenting section ends -->

                <!-- recent login section start -->
                <section class="details" id="log">
                    <h1 class="heading"> <span>Recent </span>Login </h1>
                    <div class="row">
                        <!-- ================= New Customers ================ -->
                        <div class="recentCustomers">
                            <div class="cardHeader">
                                <h2>Recent Login</h2>
                            </div>
                            <table>
                                    <?php
                                        $start = 0;
                                        $end = 10;
                                            $select_query = "SELECT * FROM users WHERE time_in BETWEEN DATE(NOW() + INTERVAL $start DAY) AND DATE(NOW() + INTERVAL $end DAY) ORDER BY time_in DESC";
                                            $result = mysqli_query($conn,$select_query);
                                        ?>
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>Name</td>
                                        <td>role</td>
                                        <td>time in</td>
                                        <td>time out</td>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        while($row = mysqli_fetch_assoc($result)) 
                                        {
                                        ?>
                                        <tr>
                                            <td  width="60px"><div class="imgBx">
                                                    <?php
                                                         if ($row['image'] == ''){
                                                              echo '<img src="uploaded_img/pic2.jpg">';
                                                            }else {
                                                              echo '<img src= "uploaded_img/'.$row['image'].'">';
                                                            }
                                                    ?>    
                                                </div></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['role'];?></td>
                                            <td><?php echo $row['time_in'];?></td>
                                            <td><?php echo $row['time_out'];?></td>            
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                </tbody>
                            </table>
                   
                        </div>
                    </div>

                </section>
                     <!-- details section end   -->
                <!-- ================ Order Details List ================= -->
                <!-- details section starts   -->
               <?php

               if (isset($_POST['approve'])) {
                    $id = $_POST['id'];

                    $select_status = "UPDATE users SET status = 'approved' WHERE id = '$id'";
                    $result_status = mysqli_query($conn, $select_status);
                    echo '<script type = "text/javascript">';
                    echo 'alert("User Approved!");';
                    echo 'window.location.href = "dashboard.php"';
                    echo '</script>';
               }

               ?>
                <section class="details" id="details">
                    <h1 class="heading"> <span>User </span>Validation </h1>
                    <div class="row">
                        <div class="recentOrders">
                            <div class="cardHeader">
                            <h2>User Validation</h2>
                        </div>
                        <table>
                                <thead>
                                     <?php 
                                            $query = "SELECT * FROM users WHERE status = 'pending' ORDER BY id ASC";
                                            $query_result = mysqli_query($conn, $query);
                                        ?>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>role</th>
                                        <th>Status</th>
                                        <th>Validation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                            while ($status = mysqli_fetch_array($query_result)) {
                                        ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $status['id']; ?></td>
                                        <td style="text-align: center;"><?php echo $status['name']; ?></td>
                                        <td style="text-align: center;"><?php echo $status['phone_no']; ?></td>
                                        <td style="text-align: center;"><?php echo $status['role']; ?></td>
                                        <td style="text-align: center;"><span class="status pending"><?php echo $status['status']; ?></span></td>
                                        <td style="text-align: center;">
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?php echo $status['id']; ?>" >
                                                <input type="submit" name="approve" value="Approve" style=" padding: 5px 10px; border-radius: 10px; background-color: green; cursor: pointer; color: white;">
                                                <a name="deny" id="deleteBtn" onclick="showModal(<?php echo $status['id']; ?>)" style=" padding: 5px 20px; border-radius: 10px; background-color: red; cursor: pointer; color: white;"> Deny </a>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                    </div>
                    </div>
                </section>
                <div id="confirmDelete" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <p>Are you sure you want to delete this record?</p>
                        <button onclick="confirmDelete()">Yes</button>
                        <button onclick="closeModal()">No</button>
                    </div>
                </div>
        <!-- details section end   -->
            
            <!-- ================ monitor Add Charts JS ================= -->
            <section class="details" id="monitor">
    <h1 class="heading"> <span>Recent </span>Patient </h1>
                    <div class="row">
                        <div class="recentOrders">
                            <div class="cardHeader">
                                <h2>Recent Patient</h2>
                               
                            </div>
                            <table>
                                <thead>
                                    <?php
                                            $select_query ="SELECT * FROM `patients`" or die('query failed');
                                            $result = mysqli_query($conn,$select_query);
                                        ?>
                                    <tr>
                                        <td>Name</td>
                                        <td>Age</td>
                                        <td>Gender</td>
                                        <td>Address</td>
                                        <td>Contact Number</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($row = mysqli_fetch_assoc($result)) 
                                        {
                                        ?>
                                    <tr>
                                        <td><?php echo $row['givenname'];?></td>
                                        <td><?php echo $row['age'];?></td>
                                        <td><?php echo $row['gender'];?></td>
                                        <td><?php echo $row['address'];?></td>
                                        <td><?php echo $row['family_no'];?></td>            
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>  
<!-- ================ CHARTBAR ================= -->
    <script>
        const ctx = document.getElementById('form1').getContext('2d');
        const data = <?php echo json_encode($chartData); ?>;

        // Generate distinct colors for each bar
        const backgroundColors = data.labels.map(() => {
            return `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.6)`;
        });

        const myChart = new Chart(ctx, {
            type: 'bar',  // Bar chart
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'TOTAL OF SYMPTOMS',
                    data: data.data,
                    backgroundColor: backgroundColors, // Use generated colors
                    borderColor: 'rgba(0, 0, 0, 0.2)',
                    borderWidth: 1,
                    hoverBorderColor: 'rgba(0, 0, 0, 2)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'TOTAL'
                        }
                    },
                    x: {
                        display: false,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    </script>

<!-- ================ SECOND CHARTBAR ================= -->
    <script>
        const ctx2 = document.getElementById('form2').getContext('2d');
        const data2 = <?php echo json_encode($chartData2); ?>;

        // Generate distinct colors for each bar
        const backgroundColors2 = data2.labels.map(() => {
            return `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.6)`;
        });

        const myChart2 = new Chart(ctx2, {
            type: 'bar',  // Bar chart
            data: {
                labels: data2.labels,
                datasets: [{
                    label: 'TOTAL OF SYMPTOMS',
                    data: data2.data,
                    backgroundColor: backgroundColors2, // Use generated colors
                    borderColor: 'rgba(0, 0, 0, 0.2)',
                    borderWidth: 1,
                    hoverBorderColor: 'rgba(0, 0, 0, 2)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'TOTAL'
                        }
                    },
                    x: {
                            display: false,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    </script>
            </div>

        </div>
        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>
        <!-- ======= Charts JS ====== -->
        <script
            src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
        <script src="assets/js/chartsJS.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module"
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>