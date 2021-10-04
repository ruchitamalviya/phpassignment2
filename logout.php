<?php
	session_start();
	unset($_SESSION['id']);
	unset($_SESSION['fname']);
	setcookie('emailcookie', '',time()-86400);
    setcookie('passwordcookie', '',time()-86400);
	header("location:login.php");
?>