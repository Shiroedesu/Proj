<style>
  .message {
      margin: 5px 0px 5px 18px;
      border-radius: 5px;
      padding: 10px;
      text-align: center;
      background-color: red;
      color: white;
      font-size: 20px;
    }
    .messageSuc {
      margin: 5px 0px;
      border-radius: 5px;
      padding: 10px;
      text-align: center;
      background-color: green;
      color: white;
      font-size: 20px;
    }
</style>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <?php
                include("config.php");
                session_start();

                if (isset($_POST['login'])) { 
                    $username = mysqli_real_escape_string($conn, $_POST['uname']);
                    $password = mysqli_real_escape_string($conn, md5($_POST['pass']));

                    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);

                    if ($row) {
                        $_SESSION['status'] = $row['status'];
                        $_SESSION['uname'] = $row['username'];
                        if ($row['status'] == "approved") {
                            if ($row['role'] == 'admin') {
                                $_SESSION['admin_id'] = $row['id'];
                                header('Location: dashboard.php');
                                $sql = "UPDATE users SET time_in = now() WHERE id =".$_SESSION['admin_id'];
                                $rs = mysqli_query($conn,$sql);
                                exit();

                            } elseif ($row['role'] == 'user') {
                                $_SESSION['user_id'] = $row['id'];
                                header('Location: user_dashboard.php');
                                $sql = "UPDATE users SET time_in = now() WHERE id =".$_SESSION['user_id'];
                                $rs = mysqli_query($conn,$sql);
                                exit();
                            }
                        } elseif ($row['status'] == "pending") {
                            $message[] = 'Your account is still pending for approval!';
                        }
                    } else {
                        $message[] = 'Username or Password is incorrect!';
                    }
                }
                ?>
          <form action="#" method="post" enctype="multipart/form-data" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <?php
            if(isset($message)){
              foreach($message as $message){
              echo '<div class="message">'.$message.'</div>';
              }
            }
            ?>
            <div class="input-field">
              <span class="icon">
                <ion-icon name="person"></ion-icon>
            </span>
              <input type="text" placeholder="Username" name="uname" required />
            </div>
            <div class="input-field">
             
              <span class="icon">
                <ion-icon name="lock-closed"></ion-icon>
            </span>
  
              <input type="password" id="password" placeholder="Password" name="pass" required />
              <span class="iconPassword">
                <ion-icon name="eye" id="eyecon"></ion-icon>
              </span>
            </div>
            <input type="submit" value="Login" name="login" class="btn solid" />
            <br>
            <p class="social-text">Forgot Password! <span class="forgot"><a href="forgot.php"> Click Here! </a></span></p> 
            
          </form>
          <form action="" method="post" enctype="multipart/form-data" class="sign-up-form">
            <?php
                include("config.php");

                if(isset($_POST['signup'])){ 
                  $name = mysqli_real_escape_string($conn, $_POST['name']);
                  $email = mysqli_real_escape_string($conn, $_POST['email']);
                  $username = mysqli_real_escape_string($conn, $_POST['username']);
                  $password = mysqli_real_escape_string($conn, md5($_POST['password']));
                  $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
                  $role = mysqli_real_escape_string($conn, $_POST['role']);


                 $select2 = mysqli_query($conn,"SELECT email FROM users WHERE email='$email'");
                 $select = mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");

                  if(mysqli_num_rows($select) > 0){
                      $message[] = 'Username already exist!';
                    }else if(mysqli_num_rows($select2) > 0){
                      $message[] = 'Email already exist!';
                    }else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                    $message[] = 'Invalid email format!';
                  }else {
                        $insert = mysqli_query($conn,"INSERT INTO `users`(name,email,username,password,phone_no,role,status) VALUES('$name','$email','$username','$password','$contact_no','$role','pending')") or die("Error Occured");

                        if($insert){
                          $messageSuc[] = 'Register Successfully!';
                        } else {
                          $message[] = 'Register Failed!';
                        }
                     }
                }
                ?>
            <h2 class="title" id="signup">Sign up</h2>
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
            <div class="input-field">
              <span class="icon">
                <ion-icon name="person-outline"></ion-icon>
            </span>
              <input type="name" placeholder="Name" name="name" required />
            </div>
            <div class="input-field">
              <span class="icon">
                <ion-icon name="mail-outline"></ion-icon>
            </span>
              <input type="email" placeholder="Email" name="email" required />
            </div>
            <div class="input-field">
              <span class="icon">
                <ion-icon name="call"></ion-icon>
            </span>
              <input type="text" placeholder="Contact Number" name="contact_no" required />
            </div>
          
            <div class="input-field">
              <span class="icon">
                <ion-icon name="person"></ion-icon>
            </span>
              <input type="text" placeholder="Username" name="username" required />
            </div>
            <div class="input-field">
              <span class="icon">
                <ion-icon name="lock-closed"></ion-icon>
            </span>
              <input type="password" id="password2" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
              <span class="iconPassword">
                <ion-icon name="eye" id="eyecon2"></ion-icon>
              </span>
            </div>
            <div class="select-container">
            <select class="select-box" id="role" name="role">
              <option  class="option" value="user" selected>User</option>
              <option  class="option" value="admin" >Admin</option>
            </select>
            <span class="icon">
            <ion-icon name="caret-down"></ion-icon>
            </span>
           </div>
           
            <input type="submit" name="signup" class="btn" value="Sign up" />
            <br>
            <p class="social-text">Already Have a Account! <span class="forgot">Sign in</span></p>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <img class="img" src="img/flogo.png">
            <h3 class="titles">Welcome to</h3>
            <a class="health"><strong>Health </strong>Informastion System </a>
            <p>
        
            </p>
            <h3>Join Us!</h3>
         <br>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Healthy Life, Happy Life!</h3>
            <p>
              Prioritizing your health is the first step toward happiness.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>
    <!-- ====== Show/Hide Password ======= -->
    <script>
      let eyecon = document.getElementById("eyecon");
      let eyecon2 = document.getElementById("eyecon2");
      let password = document.getElementById("password");
      let password2 = document.getElementById("password2");

      eyecon.onclick = function(){
        if (password.type == "password") {
          password.type = "text";

        }else {
          password.type = "password";
        }
      }
      eyecon2.onclick = function(){
        if (password2.type == "password") {
          password2.type = "text";

        }else {
          password2.type = "password";
        }
      }
    </script>
    <!-- ======  ======= -->
    <script src="app.js"></script>
     <!-- ====== ionicons ======= -->
     <script type="module"
     src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
 <script nomodule
     src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>
