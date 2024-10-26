<?php
include("config.php");
session_start();
$admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location:index.php');
    }
$id = $_GET['id'];

if (isset($_POST['update_profile'])) {
    $updated_fname = mysqli_real_escape_string($conn, $_POST['update_fname']);
    $updated_lname = mysqli_real_escape_string($conn, $_POST['update_lname']);
    $updated_mname = mysqli_real_escape_string($conn, $_POST['update_mname']);
    $updated_uname = mysqli_real_escape_string($conn, $_POST['update_uname']);
    $updated_email = mysqli_real_escape_string($conn, $_POST['update_email']);
    $updated_occupation = mysqli_real_escape_string($conn, $_POST['update_occupation']);
    $updated_role = mysqli_real_escape_string($conn, $_POST['update_role']);
    $updated_phone_no = mysqli_real_escape_string($conn, $_POST['update_phone_no']);
    $updated_dob = mysqli_real_escape_string($conn, $_POST['update_dob']);
    $updated_gender = mysqli_real_escape_string($conn, $_POST['update_gender']);


    $sql = "UPDATE users SET firstname = '$updated_fname', lastname = '$updated_lname', middlename = '$updated_mname', username = '$updated_uname', email = '$updated_email', occupation = '$updated_occupation', role = '$updated_role', phone_no = '$updated_phone_no', dob = '$updated_dob', gender = '$updated_gender' WHERE id = '$id'"
    or die ('query failed!');

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $messageSuc[] = 'Update Successfully!';
    }else {
      $message[] = 'Update Failed!';
    }

    $old_pass = $_POST['old_pass'];
    $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
    $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

    if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass) {
        $message[] = 'Old password not matched!';
      }elseif($new_pass != $confirm_pass) {
        $message[] = 'Confirm password not matched!';
      }else {
         mysqli_query($conn, "UPDATE users SET password = '$confirm_pass' WHERE id = '$id'") or die ('query failed!');
          $messageSuc[] = 'Password updated successfully!';
      }
    }
    $update_pic = $_FILES['update_pic']['name'];
    $update_file_size = $_FILES['update_pic']['size'];
    $update_tmp_name = $_FILES['update_pic']['tmp_name'];
    $update_folder = 'uploaded_img/'.$update_pic;

    if(!empty($update_pic)){
      if($update_file_size > 3000000){
        $message[] = 'Image size is too large!';
      }else {
        $updated_pic = mysqli_query($conn, "UPDATE users SET image = '$update_pic' WHERE id = '$id'") or die ('query failed!');
          if($updated_pic){
          move_uploaded_file($update_tmp_name, $update_folder);
          $messageSuc[] = 'Picture updated successfully!';
        } else {
          $message[] = 'Picture update Failed!';
        }
      }
    }
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
            <!-- ========================= Main ==================== -->
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
                <h1 class="heading"> EDIT <span>USER</span> PROFILE</h1>
                <div class="data">
                    <?php
                         $sql2 = "SELECT * FROM users WHERE id = $id";
                         $result = mysqli_query($conn, $sql2);
                         $row = mysqli_fetch_assoc($result);
                    ?>
                <form action="" method="post" enctype="multipart/form-data">
                   <div class="form"> 
                    <div class="inputs">
                        <div class="head">
                            <span>User Profile</span>
                        </div>
                        <div>
                            <a href="admin_profile.php? id=<?php echo $row['id'];?>"> Back </a>
                            <input type="submit" value="Save" name="update_profile">
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
                                <?php
                                        if(isset($message)){
                                          foreach($message as $message){
                                          echo '<div class="message">'.$message.'</div>';
                                          }
                                        }
                                    ?>
                                    <?php
                                        if(isset($messageSuc)){
                                          foreach($messageSuc as $messageSuc){
                                          echo '<div class="messageSuc">'.$messageSuc.'</div>';
                                          }
                                        }
                                    ?>
                            <div class="field">
                                <span>Firstname:</span>
                                <input type="text" name="update_fname" value="<?php echo $row['firstname']; ?>">
                            </div>
                            <div class="field">
                                <span>Lastname:</span>
                                <input type="text" name="update_lname" value="<?php echo $row['lastname']; ?>">
                            </div>
                            <div class="field">
                                <span>Middlename:</span>
                                <input type="text" name="update_mname" value="<?php echo $row['middlename']; ?>">
                            </div>
                            <div class="field">
                                <span>Username:</span>
                                <input type="text" name="update_uname" value="<?php echo $row['username']; ?>">
                            </div>
                            <div class="field">
                                <span>Email</span>
                                <input type="text" name="update_email" value="<?php echo $row['email']; ?>">
                            </div>
                            <div class="field">
                                <span>Gender</span><br>
                                <input type="radio" name="update_gender" id="Male" value="Male" <?php if($row['gender']=='Male'){echo "checked";} ?>>
                                <label for="Male">Male</label>
                                <input type="radio" name="update_gender" id="Female" value="Female"<?php if($row['gender']=='Female'){echo "checked";} ?>>
                                <label for="Female">Female</label>
                            </div>
                            <div class="field">
                                <span>Occupation:</span>
                                <input type="text" name="update_occupation" value="<?php echo $row['occupation']; ?>">
                            </div>
                            <div class="field">
                                <span>Phone No:</span>
                                <input type="text" name="update_phone_no" value="<?php echo $row['phone_no']; ?>">
                            </div>
                            <div class="field">
                                <span>User Type:</span>
                                <select class="select-box" id="role" name="update_role">
                                      <option  class="option" value="user" >User</option>
                                      <option  class="option" value="admin" >Admin</option>
                                    </select>
                            </div>
                            <div class="field">
                                <span>Date of Birth:</span>
                                <input type="date" name="update_dob" value="<?php echo $row['dob']; ?>">
                            </div>
                            <input type="hidden" name="old_pass" value="<?php echo $row['password']; ?>" >
                            <div class="field">
                                <span>Change Password?</span>
                                <input type="password" name="update_pass" placeholder="Enter Old Password" >
                            </div>
                            <div class="field">
                                <span>New Password:</span>
                                <input type="password" name="new_pass" placeholder="Enter New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            </div>
                            <div class="field">
                                <span>Confirm Password:</span>
                                <input type="password" name="confirm_pass" placeholder="Confirm New Password">
                            </div>
                            <div class="field">
                                <span>Update Pic:</span>
                                <input type="file" name="update_pic" accept="image/jpg, image/jpeg, image/png">
                            </div>
                        </div>
                    </div>
                  </div>
                </form>
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
