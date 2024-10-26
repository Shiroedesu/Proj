<?php
	include("config.php");
	session_start();
	$sql = "UPDATE users SET time_out = now() WHERE id =".$_SESSION['user_id'];
                                $rs = mysqli_query($conn,$sql);
	unset($_SESSION['user_id']);
	header('location:index.php');
	
?>