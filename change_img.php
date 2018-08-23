<?php
//	require('header.php');
	session_start();
	require_once('con.php');
	require('assay.php');
	$user_id = $_SESSION['users']['id'];
	$name = $_SESSION['users']['name'];
	$surname = $_SESSION['users']['surname'];
	$gender = $_SESSION['users']['gender'];
	$profil_img = $_SESSION['users']['profil_img'];
	$homeBg = $_SESSION['users']['homeBg'];
	$file_tmp = $_FILES['file']['tmp_name'];
	$file_name = $_FILES['file']['name'];
	if (isset($_POST['type'])) {
		if ($_FILES['file']['error'] != 0) {
		    	echo 3;
    	}
    	else if ($_POST['type'] == 'profile_img' || $_POST['type'] == 'cover_img') {
   					if (assayImg() == true) {
        					echo 1;   
      				}
      				else {
        					echo 0;
      				}
    	}
	}

// profil 

	if ($_POST['type'] == 'profileUpload') {
      	if (assayImg() == true) {
        	if (!file_exists("images/$user_id")) {
            	mkdir("images/$user_id");
        	}
        	if($profil_img){
          		unlink($profil_img);
        	}
        	$profil_img = "images/$user_id/".$file_name;
        	move_uploaded_file($file_tmp, $profil_img);
        	$_SESSION['users']["profil_img"] = $profil_img;
        	$update = mysqli_query($con,"update users set profil_img = '$profil_img' where id = '$user_id'");
        	if ($update) {
          		echo $profil_img;
        	}
        	else {
          		echo 4;
        	}
      	}
  	}


// cover


  	if ($_POST['type'] == 'coverUpload') {
      	if (assayImg() == true) {
        	if (!file_exists("images/$user_id")) {
            	mkdir("images/$user_id");
        	}
        	if($homeBg){
          		unlink($homeBg);
        	}
        	$homeBg = "images/$user_id/".$file_name;
        	move_uploaded_file($file_tmp, $homeBg);
        	$_SESSION['users']["homeBg"] = $homeBg; 
        	$update = mysqli_query($con,"update users set homeBg = '$homeBg' where id = '$user_id'");
        	if ($update) {
          		echo $homeBg;
        	}
        	else {
          		echo 4;
        	}
      	}
  	}




	
?>

