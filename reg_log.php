<?php
            session_start();
            require_once('con.php');
            if (isset($_POST['arrayLog'])) {
              $arrayLog = $_POST['arrayLog'];
              $empty_key = [];
              foreach ($arrayLog as $key => $value) {
                if ($value == '') {
                    array_push($empty_key, $key);
                }
              }
              if(count($empty_key) != 0){
                echo json_encode($empty_key);
              }
              else {
                      $login = $_POST['arrayLog']['formlogin'];
                      $password = $_POST['arrayLog']['formPassword'];
                      $obj = mysqli_query($con,"SELECT * FROM users WHERE login = '$login' AND password = '$password'");
                      if (mysqli_num_rows($obj) == 0) {
                            echo 0;
                      }
                      else {
                            if (isset($_POST['arrayLog']['remember'])) {
                               setcookie( "user_id", $_SESSION['users']['id'], time()+(60*60*24*30) );
                            }
                            $fetch = mysqli_fetch_assoc($obj);
                            $_SESSION['users'] = $fetch;
                              echo 1;
                      }
               }
            }
            if (isset($_POST['obj'])) {
                $obj = $_POST['obj'];
                $empty_keys = [];
                $input_length =[];
                foreach ($obj as $key => $value) {
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
                    $select = "SELECT login FROM users WHERE login = '$inputLogin'";
                    $result = mysqli_query($con, $select);
                if (mysqli_num_rows($result) == 0) {
                      $sql = "INSERT INTO users (name, surname, login, password, gender) VALUES ('$inputName', '$inputSurname', '$inputLogin', '$inputPassword', '$gender')";
                      if(mysqli_query($con, $sql)){
                          echo 1;                  
                      }
                }
                  else {
                      echo 0;
                  }
                }
            }


/*            $error = "";
            $profil_img = "";
            $registred = false;
            if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["login_reg"]) && isset($_POST["password_reg"])){
                $name = $_POST["name"];
                $surname = $_POST["surname"];
                $login_reg = $_POST["login"];
                $password_reg = $_POST["password"];
                $gender = $_POST["radio_gender"];
                if (isset($_POST["profil_img"])) {
                    $profil_img = $_POST["profil_img"];
                }
                if($name == "") {
                    $error .= "</br>anun chka";
                }
                if ($surname == "") {
                    $error .= "</br>azganun chka";
                }
                if ($login == "") {
                    $error .= "</br>login chka";
                }
                if ($password == "") {
                    $error .= "</br>password chka";
                } 
                if ($error == "") {
                  $select = "SELECT login FROM users WHERE login = '$login_reg'";
                  $result = mysqli_query($connection, $select);
                  if (mysqli_num_rows($result) != 0) {
                      echo "tenc login ka";
                      echo 0;
                  }
                  else{
                $sql = "INSERT INTO users (name, surname, login, password, gender, profil_img) VALUES ('$name', '$surname', '$login_reg', '$password_reg', '$gender', '')";
                if(mysqli_query($connection, $sql)){
                    echo 1;
//                 $_POST = [];
//header("Location: home.php");
//home.php
                   //echo "duq grancvel eq";
                    $name = "";
                    $surname = "";
                    $login_reg = "";
                    $registred = true;
 //                   header("Location:index.php");
                    } 
                }
            }
}
*/
?>
