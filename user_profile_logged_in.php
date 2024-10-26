<?php
include("config.php");
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
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
        <link rel="stylesheet" href="edit_user.css">
        <link rel="stylesheet" href="aaa.css">
        <script src="js2.js"></script>
    </head>
    <body>
        <?php
                $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
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
                        <a href="user_profile_logged_in.php">
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
                        <a href="user_dashboard.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_Records.php">
                            <span class="icon">
                                <ion-icon name="receipt-outline"></ion-icon>
                            </span>
                            <span class="title">Records</span>
                        </a>
                    </li>
                    <li>
                        <a href="issuance.php">
                            <span class="icon">
                                <ion-icon name="print-outline"></ion-icon>
                            </span>
                            <span class="title">Issuance</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_profile_logged_in.php" class="dashboard">
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
                <h1 class="heading"> <span>USER</span></h1>
                <div class="data">
                    <?php
                         $sql2 = "SELECT * FROM users WHERE id = $user_id";
                         $result = mysqli_query($conn, $sql2);
                         $row = mysqli_fetch_assoc($result);
                    ?>
                   <div class="form"> 
                    <div class="inputs">
                        <div class="head">
                            <span>User Profile</span>
                        </div>
                        <div>
                            <a href="edit_user_profile_logged_in.php? id=<?php echo $row['id'];?>"> Edit </a>
                        </div>
                    </div>
                    <div class="wrapper">
                        <div class="image">
                             <?php
                                 if ($row['image'] == ''){
                                      echo '<img src="uploaded_img/pic2.jpg">';
                                    }else {
                                      echo '<img src= "uploaded_img/'.$row['image'].'">';
                                    }
                            ?>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <span>Firstname:</span>
                                <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>">
                            </div>
                            <div class="field">
                                <span>Lastname:</span>
                                <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>">
                            </div>
                            <div class="field">
                                <span>Middlename:</span>
                                <input type="text" name="middlename" value="<?php echo $row['middlename']; ?>">
                            </div>
                            <div class="field">
                                <span>Username:</span>
                                <input type="text" name="username" value="<?php echo $row['username']; ?>">
                            </div>
                            <div class="field">
                                <span>Email</span>
                                <input type="text" name="email" value="<?php echo $row['email']; ?>">
                            </div>
                            <div class="field">
                                <span>gender</span>
                                <input type="text" name="gender" value="<?php echo $row['gender']; ?>">
                            </div>
                            <div class="field">
                                <span>Occupation:</span>
                                <input type="text" name="occupation" value="<?php echo $row['occupation']; ?>">
                            </div>
                            <div class="field">
                                <span>Phone No:</span>
                                <input type="text" name="phone_no" value="<?php echo $row['phone_no']; ?>">
                            </div>
                            <div class="field">
                                <span>User Type:</span>
                                <input type="text" name="role" value="<?php echo $row['role']; ?>">
                            </div>
                            <div class="field">
                                <span>Date of Birth:</span>
                                <input type="date" name="dob" value="<?php echo $row['dob']; ?>">
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>
        <!-- ====== ionicons ======= -->
        <script type="module"
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>
