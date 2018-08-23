<?php 
		require('header.php');
		require_once('con.php');
		require('modals.php');
		if ($homeBg == '') {
			$srcBg = "img/" . 'fox2.jpg';
		}
		else {
			$srcBg = $homeBg;
		}
		if ($profil_img == "") {
			$src = "img/" . "$gender" . ".jpg";
		}
		else {
			$src = $profil_img;

		}
		$post_result = mysqli_query($con,"SELECT * FROM posts WHERE user_id = '$user_id' ORDER BY id DESC");
		$comment_select = mysqli_query($con,"SELECT * FROM comments WHERE user_id = '$user_id'");
?>


<form>
	<div class="img">
		<img class='profile_img' src="<?php 
					echo $src;
			?>"  height="200px" width="200px" style="color:#000">
			<button type="button" id='profile_img' class="change_img change_profil_img" data-name='profileUpload' data-toggle="modal" data-target="#myModalImg">CHANGE PROFILE PHOTO</button>
			<button id="DelProfileImg" type="button" class="deleteImg deleteImgProfile <?php 
				if ($profil_img != '') {
					echo 'addImgDel';
			}?>">DELETE PROFILE PHOTO</button>
	</div>		
</form>
<div class='home_bg'>
	<img class='home_bg w3-round-small' src='<?php 
		echo $srcBg;
	?>'>
</div>
<div class="del_coverImg">
	<button type="button" id='cover_img' class="change_img change_background_img" data-name='coverUpload' data-toggle="modal" data-target="#myModalImg">CHANGE BACKGROUND PHOTO</button>
	<button id="DelCoverImg" type="button" class="deleteCover deleteImg <?php 
		if ($homeBg != '') {
			echo 'addImgDel';
		}
	?> ">DELETE COVER PHOTO</button>
</div>
<div style='display:inline-block'>
	<button type='button' data-name='coverUpload' data-toggle="modal" data-target="#myModalPost"> add post</button>
</div>
<div class='post_data'>
	<?php 
		while ($fetch = mysqli_fetch_assoc($post_result)) {
			echo '<div class="post_name">'.$fetch["post_name"].'</div>
			<div class="post_date">'.$fetch["post_date"].'</div>
			<span class="glyphicon glyphicon-remove remove_post" data-post-id = '.$fetch["id"].'>delete</span>
			<div class="post_div"><img class="append_post_img" src="'.$fetch["image"].'" height="400px" width="760px">
				<div class="comment">
					<input type="text" class="comment_inp">
						<button type="button" class="comment_btn">comment
						</button>
					<input type="hidden" class="post_id" value="'.$fetch["id"].'">	
					<div class="comment_print">';
					$comment_select = mysqli_query($con,"SELECT * FROM comments WHERE post_id = '".$fetch["id"]."' ORDER BY id DESC");
						while ($fetch_comment = mysqli_fetch_assoc($comment_select)) {
							$comment_user = mysqli_query($con,"SELECT * FROM users WHERE id = '".$fetch_comment["user_id"]."'");
							$fetch_user = mysqli_fetch_assoc($comment_user);
							if ($fetch_user['profil_img'] == '') {
									$fetch_user['profil_img'] = "img/".$fetch_user['gender'].'.jpg';
							}
							echo '<div class="comment_print_user">
							<div class="comment_text">'.$fetch_comment['text_com'].'</div>
								<div class="user_data">
									<div class="comment_div">'.$name.'</div>
										<div class="comment_div">'.$surname.'</div>
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
		};
	?>
</div>

<?php
   require('footer.php');
?>  




