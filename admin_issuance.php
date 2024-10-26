<?php
include("config.php");
session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:http://localhost/HIS/index.php');
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
        <link rel="stylesheet" href="assets/css/certificate_style.css">
        <link rel="stylesheet" href="aaa.css">
        <script src="js.js"></script>
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
            <img class="img" src="assets/imgs/flogo.png">
                <a class="health"><strong>Health </strong>Data Management System </a>

            <div id="menu-btn" class="fas fa-bars"></div>
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user">
                    <a href="http://localhost/HIS/admin_profile_logged_in.php">
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
                    <li></li>
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
                        <a href="issuance.php" class="dashboard">
                            <span class="icon">
                                <ion-icon name="print-outline" style="color: #227C67;"></ion-icon>
                            </span>
                            <span class="title" style="color: #227C67;">Issuance</span>
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
                <!-- ======================= dashboard ================== -->
                <section class="dashboard" id="dashboard">
                    <h1 class="heading">
                        <span>Issuance</span>
                    </h1>
                    <div class="row">
                        <main>
                            <label class="yourname" for="name">Type Your Name</label>
                            <input
                                required
                                type="text"
                                name="Name"
                                autocomplete="name"
                                placeholder="Full Name"
                                id="name"
                                minlength="3"
                                maxlength="30"
                            >
                            <div class="cardBox">
                                <a class="card" Button id="submitBtn1">
                                    <div>
                                        <div class="cardName">ITR(individual treatment record)</div>
                                        <image
                                            class="image"
                                            src="assets/imgs/cert1.png"
                                            alt
                                            style="height: 350px;"
                                        ></image>
                                    </div>
                                </a>
                                <a class="card" Button id="submitBtn2">
                                    <div>
                                        <div class="cardName">Postpartum record</div>
                                        <image
                                            class="image"
                                            src="assets/imgs/cert2.png"
                                            alt
                                            style="height: 350px;"
                                        ></image>
                                    </div>
                                </a>
                                <a class="card" Button id="submitBtn3">
                                    <div>
                                        <div class="cardName">Prenatal Record</div>
                                        <image
                                            class="image"
                                            src="assets/imgs/cert3.png"
                                            alt
                                            style="height: 350px;"
                                        ></image>
                                    </div>
                                </a>
                                <a class="card" Button id="submitBtn4">
                                    <div>
                                        <div class="cardName">Health Record</div>
                                        <image
                                            class="image"
                                            src="assets/imgs/cert4.png"
                                            alt
                                            style="height: 350px;"
                                        ></image>
                                    </div>
                                </a>
                            </section>
                            <!-- dashboard section end   -->
                        </div>
                    </main>
                    <script src="https://unpkg.com/pdf-lib@1.4.0"></script>
                    <script src="FileSaver.js"></script>
                    <script src="https://unpkg.com/@pdf-lib/fontkit@0.0.4"></script>
                    <script src="cert1.js"></script>
                </div>
                <!-- ====== ionicons ======= -->
                <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            </body>
        </html>
