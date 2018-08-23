<?php
	require('header.php');
	require_once('con.php');
	$user_id = $_SESSION['users']['id'];
	if (isset($_POST['ids'])) {
		$ids = $_POST['ids'];
	$is_del =false;
	for ($i=0; $i < count($ids); $i++) { 
		$del_folder = rmdir("images/$user_id/". $ids[$i]);
		if (!$del_folder) {
			$is_del = true;
		}
	}
	if ($is_del == false) {
		$str = implode(',',$ids);
		$del = mysqli_query($con,"delete from album where id in ($str)");
			if ($del) {
				echo 1;
			}
	}
	}
	else {
		echo 0;
	}
?>