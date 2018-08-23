<?php 
	require('header.php');
	require_once('con.php');
	require('modals.php');
	if (isset($_GET['guest_user_id'])) {
		$guest_user_id = $_GET['guest_user_id'];
		if (is_numeric($guest_user_id)) {
			if ($guest_user_id == $user_id) {
//				header("Location:home.php");
			}
			else {
				$select = mysqli_query($con,"SELECT * FROM users WHERE id ='$guest_user_id'");
				if (mysqli_num_rows($select) != 0) {
            		$fetch = mysqli_fetch_assoc($select);  
            		$name = $fetch['name'];
					$surname = $fetch['surname'];
					$gender = $fetch['gender'];
					$profil_img = $fetch['profil_img'];
  					$homeBg = $fetch['homeBg'];
        		}
        		else {
//					header("Location:logOut.php");
				}
			}	
		}
		else {
//			header("Location:logOut.php");
		}
	}
	else {
//		header("Location:logOut.php");
	}
	if ($profil_img == "") {
		$src = "img/" . "$gender" . ".jpg";
	}
	else {
		$src = $profil_img;

	}
  	if ($homeBg == '') {
		$srcBg = "img/" . 'fox2.jpg';
	}
	else {
		$srcBg = $homeBg;
	}	
	$post_result = mysqli_query($con,"SELECT * FROM posts WHERE user_id = '$guest_user_id' ORDER BY id DESC");
	$select_friend = mysqli_query($con,"SELECT * FROM friends WHERE (us_id = '$user_id' and fr_id = '$guest_user_id') or (us_id = '$guest_user_id' and fr_id = '$user_id')");	
	$fetch_ok = mysqli_fetch_assoc($select_friend);
	
	
?>


<form>
	<div class="img">
		<img class='profile_img' src="<?php 
					echo $src;
			?>"  height="200px" width="200px" style="color:#000">
	</div>	
	<div class="navbar-header">
      				<a class="navbar-brand" href="home.php">
                <span class='top_name1'><?php
                        echo $name;
                  ?></span>
                  <span class='top_surname1'>
                    <?php
                        echo $surname;
                    ?>
                  </span>
            		</a>
    </div>	
</form>
<div class='message_div'>
	<button type='button' class='<?php 
			if ($fetch_ok['friend'] == 1) {
				echo 'sms_block';
			}
		?> message_button btn btn-success'>messenger</button>
</div>	
<form method='POST'>
	<div class='friend'>
		<span class="oks glyphicon glyphicon-ok <?php 
			if ($fetch_ok['friend'] == 1) {
				echo 'ok';
			}
		?>"> 
		</span>
		<span class="oks glyphicon glyphicon-remove <?php 
			if ($fetch_ok['friend'] == 2) {
				echo 'no';
			}
		?>"> 
		</span>
		<button type='button' data-guest-id = "<?php echo $guest_user_id ?>" name='friend' class="addFriend btn btn-primary <?php 
		if (mysqli_num_rows($select_friend) != 0) {
			if ($fetch_ok['friend'] == 2) {
				echo 'btn-primary';
				$delet_friend_request = mysqli_query($con,"delete from friends  where (us_id = '$user_id' and fr_id = '$guest_user_id') or (us_id = '$guest_user_id' and fr_id = '$user_id')");
			}
			echo 'btn-success';
		}
		else {
			echo 'btn-primary';
		} 
		?>"> add friend</button>
	</div>
</form>
<div class='home_bg'>
	<img class='home_bg w3-round-small' src='<?php 
		echo $srcBg;
	?>'>
</div>
	<div class='post_data'>
	<?php  
		$selectOk = mysqli_query($con,"SELECT * FROM friends WHERE (us_id = '$user_id' and fr_id = '$guest_user_id') or (us_id = '$guest_user_id' and fr_id = '$user_id') and friend = 1");
		if (mysqli_fetch_assoc($selectOk) != 0){
			while ($fetch = mysqli_fetch_assoc($post_result)) {
				echo '<div class="post_name">'.$fetch["post_name"].'</div>
				<div class="post_date">'.$fetch["post_date"].'</div>
				<div class="post_div"><img class="append_post_img" src="'.$fetch["image"].'" height="400px" width="760px">
					<div class="comment">
						<input type="text" class="comment_inp">
							<button type="button" class="comment_btn">comment
							</button>
						<input type="hidden" class="post_id" value="'.$fetch["id"].'">	
						<div class="comment_print">';
							$comment_select = mysqli_query($con,"SELECT * FROM comments WHERE post_id = '".$fetch["id"]."'");
							while ($fetch_comment = mysqli_fetch_assoc($comment_select)) {
								$comment_user = mysqli_query($con,"SELECT * FROM users WHERE id = '".$fetch_comment["user_id"]."'");
								$fetch_user = mysqli_fetch_assoc($comment_user);
								if ($fetch_user['profil_img'] == '') {
										$fetch_user['profil_img'] = "img/".$fetch_user['gender'].'.jpg';
								}
								echo '<div class="comment_print_user">
								<div class="comment_text">'.$fetch_comment['text_com'].'</div>
									<div class="user_data">
										<div class="comment_div">'.$fetch_user['name'].'</div>
											<div class="comment_div">'.$fetch_user['surname'].'</div>
												<div class="comment_div">
													<img  class="header_img" src="'.$fetch_user['profil_img'].'" height="40px" width="40px" class="img_pro">
	  											</div>
	  										</div>
	  									</div>';
							}
					echo    '</div>
						</div>
					</div>
				</div>';
			}
		}	
	?>
</div>
<div class='message_sms_main'>
	<div class="message_name">
<!--    <a class="navbar-brand" href="guest.php"> -->
            <span class='top_name'>
            	<?php
                    echo $name;
             	?></span>
            <span class='top_surname'>
                <?php
                    echo $surname;
                ?>
            </span>    
<!--             		</a>   -->
	<button type='button' class='close_message'>X</button>
    </div>
    <div class='body_sms'>
    	<?php 
    		$select_sms = mysqli_query($con,"SELECT * FROM message WHERE user_id = '$user_id' or user_id = '$guest_user_id'");
//    		$select_smsG = mysqli_query($con,"SELECT * FROM message WHERE ");
    			while ($fetch_sms = mysqli_fetch_assoc($select_sms)) {
    				if ($fetch_sms['user_id'] == $user_id) {
    					echo '<div class="left">'.$fetch_sms['sms'].'</div>';
    				}
    				else if ($fetch_sms['user_id'] == $guest_user_id) {
    					echo  '<div class="right">'.$fetch_sms['sms'].'</div>';
    				}
    				
    			}
//    			while ($fetch_smsG = mysqli_fetch_assoc($select_smsG)) {
 //   				echo  '<div class="right">'.$fetch_smsG['sms'].'</div>';
  //  			}
    	?>
    </div>
    <div class='message_sms_div'>
    	<input type='hidden' class='guest_id' value="<?php echo $_GET['guest_user_id']?>">
    	<input type='text' class='message_sms'>
    	<button type='button' class='send_sms btn btn-warning'>SEND</button>
    </div>	
</div>
<?php
   require('footer.php');
?>  