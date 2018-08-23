<?php 
	session_start();
	require_once('con.php');
	var_dump($_POST);die;
	$user_id = $_SESSION['users']['id'];
	$guest_id = $_POST['guest_id'];
	$sms = $_POST['sms'];
	if (isset($_POST['sms'])) {
		$sql = mysqli_query($con,"INSERT INTO message (sms, user_id, guest_id) VALUES ('$sms', '$user_id', '$guest_id'");
		echo 1;
	}
?>