<?php include 'change_password_process_now.php'?>

<style>
  .message {
      margin: 5px 0px 5px 18px;
      width: 35%;
      border-radius: 5px;
      padding: 10px;
      text-align: center;
      background-color: red;
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
    <link rel="stylesheet" href="change.css" />
    <title>Change Password</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="post" enctype="multipart/form-data" class="sign-in-form">
          
            <h2 class="title">Change Password</h2>
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
              <input type="email" placeholder="Email" name="email" value="<?php if(isset($_GET['email'])) {echo $_GET['email'];};?>" />
            </div>

            <div class="input-field">
              <span class="icon">
                <ion-icon name="lock-closed"></ion-icon>
            </span>
              <input type="password" id="password" name="new_password" placeholder="Password" />
              <span class="iconPassword">
                <ion-icon name="eye" id="eyecon"></ion-icon>
              </span>
            </div>

            <div class="input-field">
              <span class="icon">
                <ion-icon name="lock-closed"></ion-icon>
            </span>
              <input type="password" id="password2" name="cnew_password" placeholder="Confirm Password" />
              <span class="iconPassword">
                <ion-icon name="eye" id="eyecon2"></ion-icon>
              </span>
            </div>
            <input type="submit" class="btn" name="change" value="Update" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel right-panel">
          <div class="content">
            <img class="img" src="assets/imgs/flogo.png">
            <h3 class="titles">Welcome to</h3>
            <a class="health"><strong>Health </strong>Informastion System </a>
          <p></p>
            <button class="btn transparent" id="sign-up-btn">
              Sign in
            </button>
          </div>
          <img src="assets/imgs/appointment.svg" class="image" alt="" />
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
   
     <!-- ====== ionicons ======= -->
     <script type="module"
     src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
 <script nomodule
     src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>
