<?php 
	session_start();
	require_once('con.php');
	require('assay.php');
  
	$user_id = $_SESSION['users']['id'];
	$file_tmp = $_FILES['file']['tmp_name'];
	$file_name = $_FILES['file']['name'];

    if ($_POST['post_img'] == 'post') {
        if (assayImg() == true) {
        	echo 1;
        }
        else {
        	echo 0;
        }
    }


    if ($_POST['post_img'] == 'post_submit') {
    	if (!file_exists("images/$user_id")) {
              mkdir("images/$user_id");
          }
          $post_name = $_POST['text_val'];
          $image = "images/$user_id/".$file_name;
          move_uploaded_file($file_tmp, $image);
          $_SESSION['posts']["image"] = $image;
          $sql = mysqli_query($con,"INSERT INTO posts (post_name, image, user_id, post_date) VALUES ('$post_name', '$image', '$user_id', NOW())");
          if ($sql) {
              echo 1;
          }
          else {
              echo 4;
          }
    
    }
?>





