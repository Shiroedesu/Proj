<?php
    include("config.php");

    if(isset($_GET['code'])) {
        $code = $_GET['code'];

        $verifyQuery = $conn->query("SELECT * FROM user WHERE code = '$code' and updated_time >= NOW() - Interval 1 DAY");

        if($verifyQuery->num_rows == 0) {
            header("Location: index.html");
            exit();
        }

        if(isset($_POST['change'])) {
            $email = $_POST['email'];
            $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));
            $cnew_password = mysqli_real_escape_string($conn, md5($_POST['cnew_password']));

            if ($new_password != $cnew_password){
                $message[] = 'Password not matched';
            } else{
            $changeQuery = $conn->query("UPDATE user SET password = '$new_password' WHERE email = '$email' and code = '$code' and updated_time >= NOW() - INTERVAL 1 DAY");

            if($changeQuery) {
                header("Location: success.html");
            }
        }
        $conn->close();
    }
}
    else {
        header("Location: index.php");
        exit();
    }
?>
