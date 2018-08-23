<?php 
	session_start();
	require_once('con.php');
	$user_id = $_SESSION['users']['id'];
	$post_id = $_POST['post_id'];
	$text_com = $_POST['text_com'];
	if (isset($_POST['text_com'])) {
		$sql = mysqli_query($con,"INSERT INTO comments (text_com, post_id, user_id, date_comment) VALUES ('$text_com', '$post_id', '$user_id', NOW())");
		echo 1;
	}
?>