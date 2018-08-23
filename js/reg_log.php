<?php
//          require('header.php');
            require_once('con.php');
//            $error = "";
//            $profil_img = "";
//            $registred = false;
            if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["login_reg"]) && isset($_POST["password_reg"])){
                $name = $_POST["name"];
                $surname = $_POST["surname"];
                $login_reg = $_POST["login"];
                $password_reg = $_POST["password"];
/*                $gender = $_POST["radio_gender"];
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
                } */
  //              if ($error == "") {
                  $select = "SELECT login FROM users WHERE login = '$login_reg'";
                  $result = mysqli_query($connection, $select);
                  if (mysqli_num_rows($result) != 0) {
                      echo "tenc login ka";
                      echo 0;
 //                 }
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
 //                   $registred = true;
 //                   header("Location:index.php");
                    } 
                }
            }
}
?>