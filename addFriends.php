<?php 
	session_start();
	require_once('con.php');
    $user_id = $_SESSION['users']['id']; 
    $guest_user_id = $_POST['fr_id'];
    if (isset($_POST['fr_id'])) {
    $select_friend = mysqli_query($con,"SELECT * FROM friends WHERE (us_id = '$user_id' and fr_id = '$guest_user_id') or (us_id = '$guest_user_id' and fr_id = '$user_id')");
    if (mysqli_num_rows($select_friend) == 0) {
        $sql = mysqli_query($con,"INSERT INTO friends (us_id, fr_id, friend) VALUES ('$user_id', '$guest_user_id', 0)");
        if ($sql) {
        	echo 1;
        }
        else {
        	echo 0;
        }
    }
    else {
        $delet_friend_request = mysqli_query($con,"delete from friends  where (us_id = '$user_id' and fr_id = '$guest_user_id') or (us_id = '$guest_user_id' and fr_id = '$user_id')");
        echo 2;
    }
           
        
            
                      
    }  
?>