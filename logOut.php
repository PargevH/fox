<?php 
	session_start();
	unset($_SESSION['users']); //jnjeci sessian
	session_destroy();
	setcookie("user_id", '', time() - 1);

	header("Location:index.php"); 
	
?>