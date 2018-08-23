<?php
	require('header.php');
	require_once('con.php');
?>
<form id='form_edit' method='post'>
    <div class="form-group">
      	<label for="inputdefault" class="lable_edit">profile name</label>
      	<input type="text" name='name' class='input_edit' id='name' value="<?php 
			echo $name;
		?>">
    </div>
    <div class="form-group">
      	<label for="inputlg" class="lable_edit">profile surname</label>
      	<input type="text" name='surname' class='input_edit' id='surname' value="<?php 
			echo $surname;
		?>">
    </div>
    <div class="form-group">
      	<label for="inputsm" class="lable_edit">profile login</label>
      	<input type="text" name='login' class='input_edit' id='login' value="<?php 
			echo $login;
		?>">
    </div>
    <div class="form-group">
      	<label for="sel1" class="lable_edit">profile password</label>
      	<input type="text" name='password' class='input_edit' id='password' value="<?php 
			echo $passwordProf;
		?>">
    </div>
  </form>
  <div>
  		<div class='reg_length_errors'><span>length < 3</span></div>
  </div>

  <div class="form-group gender_input" style="margin-right:0">
           			<label class="radio-inline">
                		<input type="radio" class="gender_input" id='gender_men' name="radio_gender" value = 'men' <?php 
                			if ($gender == "men") {
                				echo 'checked';
                			}
                		?>>  Men
            		</label>
            		<label class="radio-inline">
                		<input type="radio" class="gender_input" id='gender_women' name="radio_gender" value = 'women' <?php 
                			if ($gender == "women") {
                				echo 'checked';
                			}
                		?>>Women
            		</label>
           		</div>

  <button type="button" class="editProfileSettings">EDIT PROFIL SETTINGS</button>



  <?php 
  	require('footer.php');
  ?>