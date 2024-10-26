<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="forgot.css" />
    <title>Forgot Password</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="forgot_password_process_now.php" method="post" class="sign-in-form">
          
            <h2 class="title">Verify Your Email</h2>
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
         
              <input type="email" name="email" placeholder="User Email" class="box" autocomplete="off" required/>
            </div>
           
            <input type="submit" value="Send" name="reset" class="btn solid" />
            <br>
            <p class="social-text">Back to Sign in!</p><a href="index.php" class="forgot">Click Here!</a>
            
          </form>
          
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <img class="img" src="assets/imgs/flogo.png">
            <h3 class="titles">Welcome to</h3>
            <a class="health"><strong>Health </strong>Informastion System </a>
            <p>
        
            </p>
            <h3>Join Us!</h3>
         <br>
            <button class="btn transparent" id="sign-up-btn">
              Sign in
            </button>
          </div>
          <img src="assets/imgs/log.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="assets/js/forgot.js"></script>
     <!-- ====== ionicons ======= -->
     <script type="module"
     src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
 <script nomodule
     src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>
