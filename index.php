<?php
 session_start();
            require_once('con.php');
    if (isset($_COOKIE['user_id'])) {
        $userId = $_COOKIE['user_id'];
        $select = mysqli_query($con,"SELECT * FROM users WHERE id='$userId'");
         $fetch = mysqli_fetch_assoc($select);
                            $_SESSION['users'] = $fetch;
                            header('Location: home.php');
?>
<html>
	<head>
		<title>fox.am</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div id = 'bg_img'></div>
		<div class='reg_form'>
			<form action="" method="POST" class="form-horizontal form_main">
            	<div class="form-group index_group" style="margin-right:0">
                	<label for="inputName" class="col-md-2 control-label name index_label">Name</label>
                		<div class="col-md-10">
                   			<input type="text" name="name" class="form-control form_input_reg input_reg" id="inputName" placeholder="Name:">
                		</div>
            	</div>
            	<div class="form-group index_group" style="margin-right:0">
                	<label for="inputSurname" class="col-md-2 control-label surname index_label">Surname</label>
                		<div class="col-md-10">
                    		<input type="text" name="surname" class="form-control form_input_reg" id="inputSurname" placeholder="Surname:">
                		</div>
            	</div>
            	<div class="form-group index_group" style="margin-right:0">
             	   	<label for="inputLogin" class="col-md-2 control-label login_reg index_label">Login</label>
                		<div class="col-md-10">
                    		<input type="text" name="login" class="form-control form_input_reg" id="inputLogin" placeholder="Login:">
                		</div>
            	</div>
            	<div class="form-group index_group" style="margin-right:0">
                	<label for="inputPassword" class="col-md-2 control-label password_reg index_label">Password</label>
                		<div class="col-md-10">
                    		<input type="password" name="password" class="form-control form_input_reg" id="inputPassword" placeholder="Password:">
                		</div>
            	</div>
           		<div class="form-group gender_input" style="margin-right:0">
           			<label class="radio-inline">
                		<input type="radio" class="gender_input" id='gender_men' name="radio_gender" value = 'men' checked>  Men
            		</label>
            		<label class="radio-inline">
                		<input type="radio" class="gender_input" id='gender_women' name="radio_gender" value = 'women'>Women
            		</label>
           		</div>
				      <div class="form-group index_group" style="margin-right:0">
    				    <div class="col-sm-offset-2 col-sm-10">
						      <button type="button" name="reg" class="btn btn-primary glyphicon glyphicon-user button_reg" style='margin-left:-67px'>Registration</button>
<!-- 					<button type="button" class="btn btn-success glyphicon glyphicon-home button_reg">Login</button> -->
    				    </div>
<!--     <div  class="error">
        <?php
//            echo $error;
        ?>
    </div> -->
  				      </div>
        	</form>
<!--           <button type="button" name="reg_js" id="reg_js" class="btn btn-primary glyphicon glyphicon-user button_reg" style='margin-left:-67px'>Registration</button>  -->
		</div>
		<div class='errors'>
			<div class='reg_error'><span>такой логин уже существует</span></div>
			<div class='log_error'><span>ваш набранный логин или пароль неправильный</span></div>
      <div class='reg_length_errors'><span>length < 3</span></div>
		</div>
<!--		
  
		<div class="container">
  			<h2>Small Modal</h2>
  			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button>
  			<div class="modal fade" id="myModal" role="dialog">
    			<div class="modal-dialog modal-sm">
      				<div class="modal-content">
        				<div class="modal-header">
          					<button type="button" class="close" data-dismiss="modal">&times;</button>
          						<h4 class="modal-title">Modal Header</h4>
        				</div>
        				<div class="modal-body">
          					<p>This is a small modal.</p>
        				</div>
        				<div class="modal-footer">
          					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        				</div>
      				</div>
    			</div>
  			</div>
		</div>
-->
		<div class='log_form'>	
			<form action="" method="POST" class="form-horizontal form_main">
            	<div class="form-group" style="margin-right:0">
                	<label for="inputLogin" class="col-md-2 control-label">Login</label>
                		<div class="col-md-10">
                    		<input type="text" name="login" class="login_input form-control form_input_log" id="formlogin" placeholder="Login:">         
                		</div>
            	</div>
            	<div class="form-group" style="margin-right:0">
                	<label for="inputPassword" class="col-md-2 control-label">Password</label>
                		<div class="col-md-10">
                    		<input type="password" name="password" class="password_input form-control form_input_log" id="formPassword" placeholder="Password:">
                		</div>
            	</div>
              <div class="form-group" style="margin-right:0">
                  <label for="inputPassword" class="col-md-2 control-label"></label>
                    <div class="col-md-10">
                        <input type='checkbox' class='remember' name='remember' value='0'>Remember
                    </div>
              </div>
            	<div class="form-group" style="margin-right:0">
    				<div class="col-sm-offset-2 col-sm-10">
      					<button type="button" name="log" class="btn btn-success button_log">Login</button>
<!--      					<button type="submit" name="reg1" class="btn btn-primary"><a href="registre.php" style="color:#fff">registre</a></button> -->
    				</div>
        	</form>
<!--           <button type="button" name="log_js" id="log_js" class="btn btn-success button_log">Login</button>  -->
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>