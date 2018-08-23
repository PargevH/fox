<?php 
    session_start();
    require_once('con.php');
    if (isset($_POST['post_id'])) {
        $id = $_POST['post_id'];
        $select = mysqli_query($con,"SELECT * FROM posts WHERE id ='$id'");  
        if ($select) {
                $fetch = mysqli_fetch_assoc($select);
                $image = $fetch['image'];
                unlink($image);
        }  	
    	$del = mysqli_query($con,"delete from posts  where id = '$id'");
    	if ($del) {
    		echo 1;
    	}
    	else {
    		echo 0;
    	}
    }
?>