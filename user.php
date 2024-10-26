<?php
include("config.php");
session_start();
$admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location:index.php');
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
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/user_list.css">
        <link rel="stylesheet" href="aaa.css">
        <script src="js.js"></script>
        <script src="script2.js"></script>
        <link rel="stylesheet" href="aaa.css">
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
                        <a href="dashboard.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
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
                        <a href="user.php" class="dashboard">
                            <span class="icon">
                                <ion-icon name="person-outline" style="color: #227C67;"></ion-icon>
                            </span>
                            <span class="title" style="color: #227C67;">User</span>
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
                    <div id="logoutPrompt" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <p>Do you want to log out?</p>
                            <button onclick="logout()">Yes</button>
                            <button onclick="closeModal()">No</button>
                        </div>
                    </div>
            <!-- ========================= Main ==================== -->
            <div class="main">
                <h1 class="heading"> <span>USERS</span></h1>
                <div class="data">
                        <div class="inputs">
                            <div class="head">
                                <span>List of Users</span>
                            </div>
                            <div>
                                <input type="search" id="search" placeholder="Find User"></input>
                            </div>
                        </div>
                        <br></br>
                    <table class="table">
                            <thead>
                                <?php
                                    $select_query ="SELECT * FROM `users` WHERE status = 'approved'" or die('query failed');
                                    $result = mysqli_query($conn,$select_query);
                                ?>
                                    <tr>
                                        <th>ID <span class="icon-arrow">&UpArrow;</span></th>
                                        <th>NAME <span class="icon-arrow">&UpArrow;</span></th>
                                        <th>Email <span class="icon-arrow">&UpArrow;</span></th>
                                        <th>Role <span class="icon-arrow">&UpArrow;</span></th>
                                        <th>Phone <span class="icon-arrow">&UpArrow;</span></th>
                                        <th>Edit <span class="icon-arrow">&UpArrow;</span></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        while($row = mysqli_fetch_assoc($result)) 
                                        {
                                        ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['role'];?></td>
                                        <td><?php echo $row['phone_no'];?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
                                                <a href="admin_profile.php? id=<?php echo $row['id'];?>" class="edit">View</a>
                                                <a type="submit" id="deleteBtn" onclick="showModal(<?php echo $row['id']; ?>)" style=" padding: 10px 10px; border-radius: 10px; background-color: red; cursor: pointer; color: white;"> Delete </a>
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
            </div>
            </div>
            <div id="confirmDelete" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <p>Are you sure you want to delete this record?</p>
                        <button onclick="confirmDelete()">Yes</button>
                        <button onclick="closeModal()">No</button>
                    </div>
                </div>
        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>
        <!-- =========== Search & Sorting =========  -->
        <script src="search.js"></script>
        <!-- ====== ionicons ======= -->
        <script type="module"
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>
