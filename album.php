<?php
            require('header.php');
			require_once('con.php');
			$album_id = "";
            $eng_name = "";
            $arm_name = "";
            $error = "";
            $user_id = $_SESSION['users']['id'];
            if (isset($_POST["createAlbum"])) {
//				header("Location:album.php");
				if (isset($_POST['arm_name']) && $_POST['arm_name'] != '') {
					$arm_name = $_POST["arm_name"];
				}
				else{
						$error .= "lracreq arm";
				}
				if (isset($_POST['eng_name']) && $_POST['eng_name'] != '') {
					$eng_name = $_POST["eng_name"];
				}
				else{
						$error .= "lracreq eng";
				}
				$result = mysqli_query($con,"SELECT * FROM album WHERE (arm_name = '$arm_name' or eng_name = '$eng_name' and user_id = '$user_id')");
				if (mysqli_num_rows($result) == 1){
					$error = 'poxir anun@';
				}
				else {
					if ($arm_name != '' && $eng_name != '') {
						$sql = "INSERT INTO album (arm_name, eng_name, user_id) VALUES ('".$arm_name."',  '". $eng_name."', $user_id)";
						if(mysqli_query($con, $sql)){
							$id_result = mysqli_query($con,"SELECT * FROM album WHERE (arm_name = '$arm_name' or eng_name = '$eng_name' and user_id = '$user_id')");
							$id_fetch = mysqli_fetch_assoc($id_result);
							$album_id = $id_fetch['id'];
//                   			echo "ok";
							}
						}
							if (!file_exists("images/$user_id")) {
								mkdir("images/$user_id");	
							}	
							if (file_exists("images/$user_id")) {
								mkdir("images/$user_id/" . $album_id);
								}
							}	
				}
				$album_result = mysqli_query($con,"SELECT * FROM album WHERE user_id = '$user_id' ORDER BY id DESC");
				if(isset($_POST['edit_Album'])){
					$arm_name = $_POST['edit_arm_name'];
					$eng_name = $_POST['edit_eng_name'];
					$album_id = $_POST['hidden_id'];
					$update = mysqli_query($con, "UPDATE album set arm_name = '$arm_name', eng_name = '$eng_name' where id = '$album_id'");
						header("Location:album.php");
					
	}


?>            		
<!--		
		<form action="" method="POST" class="form-horizontal">
			<input type = "submit" name = "createAlbum" value = "создать альбом">
			<input type = "text" name = "textName">
		</form>
-->		
		<div class="container">
  			<form action="" method="POST" class="form-horizontal">
    			<div class="form-group">
     			 <label for="text">arm_name:</label>
			      <input type="text" class="form-control" id="text" placeholder="Enter arm_name" name="arm_name">
			    </div>
			    <div class="form-group">
			      <label for="text1">eng_name:</label>
			      <input type="text" class="form-control" id="text1" placeholder="Enter eng_name" name="eng_name">
			    </div>
			    <button type="submit" name = "createAlbum" value = "создать альбом" class="btn btn-default">создать альбом</button>
			 </form>
			</div>
			<?php
				echo $error;
			?>
			<table class="table table-condensed">
			    <tbody>	
		      	<tr>
			        <td>arm_name</td>
			        <td>eng_name</td>
			        <td>edit</td>
			        <td>delet</td>
			        <td><input type="checkbox" id="all_checkbox">  all  <!--<span class="btn btn-lg btn-danger" style="padding:3px 7px">delet</span>--></td>
			        <td><button type="button" class="btn btn-info btn-lg btn-danger" style="padding:3px 7px" data-toggle="modal" data-target="#myModal_small">delet</button></td>
			      </tr>
			      <?php
			    		while ($fetch = mysqli_fetch_assoc($album_result)) {
			    			echo '<tr>
									<td class="arm_name">'.$fetch["arm_name"].'</td>
									<td class="eng_name">'.$fetch["eng_name"].'</td>
									<td data-toggle="modal" data-target="#myModal" class="edit"><span class="glyphicon glyphicon-pencil btn btn-info btn-lg" 
									data-album-id = '.$fetch["id"].'></span></td>
									<td><span class="glyphicon glyphicon-remove remove_album" data-album-id = '.$fetch["id"].'></span></td> 
									<td><input type="checkbox" class = "checkbox_album" name="checkbox_album" data-album-id = '.$fetch["id"].'></td>
								</tr>';
						};

			    	?>

<!--
						//			   data-album-id
				      <tr>
			        <td>Mary</td>
			        <td>Moe</td>
			        <td>mary@example.com</td>
			      </tr>
			      <tr>
			        <td>July</td>
			        <td>Dooley</td>
			        <td>july@example.com</td>
			      </tr> -->
			    </tbody>
			</table>
  <!--  <h2>Modal Example</h2>
 Trigger the modal with a button 
  <button >Open Modal</button>
-->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
        	<form action="" method="POST" class="form-horizontal">
    			<div class="form-group">
     			 <label for="text">arm_name:</label>
			      <input type="text" class="form-control edit_arm" id="text" placeholder="Enter" name="edit_arm_name">
			    </div>
			    <div class="form-group">
			      <label for="text1">eng_name:</label>
			      <input type="text" class="form-control edit_eng" id="text1" placeholder="Enter" name="edit_eng_name">
			    </div>
			    <input type="hidden" class = "hidden_id"  name = "hidden_id" value = "">
			    <button type="submit" name = "edit_Album" value = "изменить альбом" class="btn btn-default">изменить альбом</button>
			 </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade" id="myModal_small" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>hastat jnjel?</p>
        </div>
        <form action="" method="POST" class="form-horizontal">
        	<button type="button" class="btn btn-danger del" name="delet_album" data-dismiss="modal">yes</button>
        	<button type="button" class="btn btn-warning" data-dismiss="modal">no</button>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php
   require('footer.php');
?> 