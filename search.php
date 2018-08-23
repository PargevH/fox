<?php 
	session_start();
    require_once('con.php');
    $text = $_POST['text'];
    if (isset($_POST['text'])) {
    		$select = mysqli_query($con,"SELECT id, name, surname, profil_img, gender FROM users WHERE name LIKE '$text%'");
    		$data = [];
   		if ($select) {
   			while ($fetch = mysqli_fetch_assoc($select)) {
   				if ($fetch['profil_img'] == '') {
   					$fetch['profil_img'] = "img/".$fetch['gender'].'.jpg';
   				}
   				array_push($data, $fetch);

   			}
   			if (count($data) != 0) {
   				echo json_encode($data);
   			}
   			//echo 1;
   		}
   		else {
   			echo 0;
   		}	
    }
?>



