<?php
	session_start();
	unset($_SESSION['nim']);
	header('location:login.php');	
	session_destroy();
?>
