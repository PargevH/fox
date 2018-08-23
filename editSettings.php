<?php
	session_start();
	require_once('con.php');
	$user_id = $_SESSION['users']['id'];
	if (isset($_POST['edit'])) {
		$edit = $_POST['edit'];
    $empty_keys = [];
    $input_length =[];
		$loginOld = $_SESSION['users']['login'];
		$passwordOld = $_SESSION['users']['password'];
		foreach ($edit as $key => $value) {
      		if ($value == '') {
            	array_push($empty_keys, $key);
      		}
      		else {
          		$$key = $value; 
      		}
      		if (strlen($value) < 3) {
            	array_push($input_length, $key);
      		}
    	}
    	if(count($empty_keys) != 0){
        	echo json_encode($empty_keys);
    	}
    	else if (count($input_length) != 0) {
        	echo 4;
    	}
    	else {
        if ($loginOld != $login || $passwordOld != $password) {
            $obj = mysqli_query($con, "SELECT * FROM users WHERE login = '$login'");
            if (mysqli_num_rows($obj) == 0 || $loginOld == $login) {
                    $sql =  mysqli_query($con,"update users set name = '$name', surname = '$surname', login = '$login', password = '$password', gender = '$gender' where id = '$user_id'");
                    echo 1;   
          }
          else {
            echo 0;
          }
        }
        else {
            $_SESSION['users']['name'] = $name;
            $_SESSION['users']['surname'] = $surname;
            $_SESSION['users']['gender'] = $gender;
            $sql = mysqli_query($con,"update users set name = '$name', surname = '$surname', gender = '$gender' where id = '$user_id'");
              echo 2;
        }
			

			
        }
	}
?>