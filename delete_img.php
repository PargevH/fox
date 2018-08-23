<?php 
	session_start();
    require_once('con.php');
    $user_id = $_SESSION['users']['id'];
    $profil_img = $_SESSION['users']['profil_img'];
    $homeBg = $_SESSION['users']['homeBg'];
    $gender = $_SESSION['users']['gender'];
	if ($_POST['delet']) {
  		if ($_POST['ids'] == 'DelProfileImg') {
  			if(file_exists($profil_img)){
        		$delete_img = mysqli_query($con,"update users set profil_img = '' where id = '$user_id'");
        		if ($delete_img) {
        			unlink($profil_img);
        			$profil_img = '';
        			$_SESSION['users']['profil_img'] = '';
        			if ($profil_img == '') {
        				$defImg = "img/" . "$gender" . ".jpg";
        				echo $defImg;
        			}
        			else {
      					echo 0;
      				}
        			
        		}
        		
      		}
      		else {
      			echo 0;
      		}
      		
  		}
    	if ($_POST['ids'] == 'DelCoverImg') {
    			if(file_exists($homeBg)){
        		$delete_img = mysqli_query($con,"update users set homeBg = '' where id = '$user_id'");
        		if ($delete_img) {
        			unlink($homeBg);
        			$homeBg = '';
        			$_SESSION['users']['homeBg'] = '';
        			if ($homeBg == '') {
        				$defImg = "img/" . 'fox2.jpg';
        				echo $defImg;
        			}
        		}
        		else {
      				echo 0;
      			}
      		}
    	}	
  	}
?>