<?php
	require('header.php');
	require_once('con.php');
	$user_id = $_SESSION['users']['id'];
	if (isset($_POST['a_id'])) {
		$id = $_POST['a_id'];
	if (is_dir("images/$user_id/" . $id)) {
		$rm = rmdir("images/$user_id/" . $id); 
		if($rm){
			$del = mysqli_query($con,"delete from album where id = '$id'");
			if ($del) {
				echo 1;

			}
			else{
					echo 0;
				}
		}
	}
}
?>