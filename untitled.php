fox







<?php 
            $select_sms = mysqli_query($con,"SELECT * FROM message WHERE user_id = '$user_id'");
            $select_smsG = mysqli_query($con,"SELECT * FROM message WHERE user_id = '$guest_user_id'");
                while ($fetch_sms = mysqli_fetch_assoc($select_sms)) {
                    echo '<div class="left">'.$fetch_sms['sms'].'</div>';
                }
                while ($fetch_smsG = mysqli_fetch_assoc($select_smsG)) {
                    echo  '<div class="right">'.$fetch_smsG['sms'].'</div>';
                }
        ?>


















 <li><span class='<?php 
                    if ($usersCount != 0) {
                      echo 'span_red';
                    }
                 ?>'  ><?php
                    if ($usersCount != 0) {
                      echo $usersCount;
                     } 
                ?></span><button style="font-size:16px" class='notice_button'><span class="glyphicon glyphicon-user"></span></button>
                   <div class='friend_notice'>
                  <?php 
                  if (count($users) != 0) {
                      foreach ($users as $user_friend) {
                        if ($user_friend['profil_img'] == '') {
                            $user_friend['profil_img'] = "img/".$user_friend['gender'].'.jpg';
                        } 
                          echo "<div class='main_div_users'>
                                  <div class='user_img'>
                                    <img class='mini_img' src='".$user_friend['profil_img']."'>
                                  </div>
                                  <div class='user_name_surname' style='text-align:left'>".$user_friend['name']." ".$user_friend['surname']."</div>
                                  <form method='POST'>
                                      <input type='hidden' name='id_user' value=".$user_friend['id'].">
                                      <div class='button_addDiv'>
                                        <button type='submit' class='add_button' name='addFriend'>add friend</button>
                                      </div>
                                      <div class='button_ignDiv'>
                                        <button type='submit' name='ignFriend' class='ign_button'>ignor</button>
                                      </div>
                                  </form>
                          </div>";
                     }
                  }
                         
                ?></div>
                </li>









<div class='friend'>
        <button type='submit' name='friend' class="btn <?php 
            $select_friends = mysqli_query($con,"SELECT friend FROM friends WHERE  us_id = '$user_id' and fr_id = '$guest_user_id' or us_id = '$guest_user_id' and fr_id= '$user_id'");
            if (mysqli_num_rows($select_friends) != 0) {
                    $fetch_friends = mysqli_fetch_assoc($select_friends);
                    if ($fetch_friends['friend'] == 1) {
                        echo 'btn-success';
                    }
                    else if ($fetch_friends['friend'] == 2) {
                        echo 'btn-warning';
                    }
                    else if ($fetch_friends['friend'] == 0) {
                        echo 'btn-danger';
                    }
                }
        ?>"> add friend</button>
    </div>

    if (isset($_POST['friend'])) {
//      $select_friend = mysqli_query($con,"SELECT friend FROM friends WHERE friend  != ' '");
//      if (mysqli_num_rows($select_friend) == 0) {
//          var_dump('1');
//      }
//      else {
//          var_dump($fetch_friend);die;
//      }
        $sql = mysqli_query($con,"INSERT INTO friends (us_id, fr_id, friend) VALUES ('$user_id', '$guest_user_id', 0)");            
    }       





session_start();
    require_once('con.php');
    $user_id = $_SESSION['users']['id'];    
    if (isset($_POST['friend'])) {
 //     $select_friend = mysqli_query($con,"SELECT * FROM friends WHERE ");
 //     if (mysqli_num_rows($select_friend) == 0) {
  //        var_dump('1');
  //    }
   //   else {
    //      var_dump($fetch_friend);die;
     // }
        $sql = mysqli_query($con,"INSERT INTO friends (us_id, fr_id, friend) VALUES ('$user_id', '$guest_user_id', 0)");   
        if ($sql) {
            echo 1;
         }             
    }  








<?php
            session_start();
            $host = 'localhost'; // адрес сервера 
            $database = 'pargev'; // имя базы данных
            $user = 'Pargev'; // имя пользователя
            $password = '1234'; // пароль
            $connection = mysqli_connect($host, $user, $password, $database);
            $error = "";
            $registred = false;
            if(isset($_POST["reg"])){
                $name = $_POST["name"];
                $surname = $_POST["surname"];
                $login = $_POST["login"];
                $password = $_POST["password"];
                $gender = $_POST["radio_gender"];
                $profil_img = $_POST["profil_img"];
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
                  $select = "SELECT login FROM users WHERE login = '$login'";
                  $result = mysqli_query($connection, $select);
                  if (mysqli_num_rows($result) != 0) {
                      echo "tenc login ka";
                  }
                  else{
                $sql = "INSERT INTO users (name, surname, login, password, gender, profil_img) VALUES ('$name', '$surname', '$login', '$password', '$gender', '')";
                if(mysqli_query($connection, $sql)){
//                 $_POST = [];
//header("Location: home.php");
//home.php
                   echo "duq grancvel eq";
                    $name = "";
                    $surname = "";
                    $login = "";
                   $registred = true;
                    } 
                }
            }
}
if (isset($_POST['reg1'])) {
    $login = $_POST["login"];
    $password = $_POST["password"];
    if($login && $password){
        $obj = mysqli_query($connection,"SELECT * FROM users WHERE login = '$login' AND password = '$password'");
        if (mysqli_num_rows($obj) == 0) {
            $error = "login@ kam password@ sxala";
        }
        else {
            $fetch = mysqli_fetch_assoc($obj);
            $_SESSION['users'] = $fetch;
            header("Location:home.php");
        }
    }
    
}
?>
<html>
  <head>
    <title>php</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>    
    <form action="" method="POST" class="form-horizontal form_main">
      <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Name</label>
        <div class="col-md-10">
          <input type="text" name="name" value="<?php if (isset($_POST['reg']) && !empty($name)) {
                        $registred = false;
                        echo $name;
                    } ?>" class="form-control 
                        <?php if(isset($_POST["reg"]) && $_POST['name'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputName" placeholder="Name:">
        </div>
      </div>
      <div class="form-group">
        <label for="inputSurname" class="col-md-2 control-label">Surname</label>
        <div class="col-md-10">
          <input type="text" name="surname" value="<?php if (isset($_POST['reg']) && !empty($surname)) {
                        $registred = false;
                        echo $surname;
                    } ?>" class="form-control 
                        <?php if(isset($_POST["reg"]) && $_POST['surname'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputSurname" placeholder="Surname:">
        </div>
      </div>
      <div class="form-group">
        <label for="inputLogin" class="col-md-2 control-label">Login</label>
        <div class="col-md-10">
          <input type="text" name="login" value="<?php if (isset($_POST['reg']) && !empty($login)) {
                        $registred = false;
                        echo $login;
                    } ?>" class="form-control
                         <?php if(isset($_POST["reg"]) && $_POST['login'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputLogin" placeholder="Login:">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword" class="col-md-2 control-label">Password</label>
        <div class="col-md-10">
          <input type="password" name="password" class="form-control
                        <?php if(isset($_POST["reg"]) && $_POST['password'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputPassword" placeholder="Password:">
        </div>
      </div>
            <label class="radio-inline">
                <input type="radio" name="radio_gender" value = 'men' checked>  Men
            </label>
            <label class="radio-inline">
                <input type="radio" name="radio_gender" value = 'women'>Women
            </label>
      <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="reg" class="btn btn-success">Submit</button>
    </div>
     <div  class="error">
        <?php
            echo $error;
        ?>
    </div>
  </div>
    </form>
        <form action="" method="POST" class="form-horizontal form_main">
            <div class="form-group">
                <label for="inputLogin" class="col-md-2 control-label">Login</label>
                <div class="col-md-10">
                    <input type="text" name="login" class="form-control 
                        <?php if(isset($_POST["reg1"]) && $_POST['login'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputLogin" placeholder="Login:">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-md-2 control-label">Password</label>
                <div class="col-md-10">
                    <input type="password" name="password" class="form-control
                        <?php if(isset($_POST["reg1"]) && $_POST['password'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputPassword" placeholder="Password:">
                </div>
            </div>
            <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="reg1" class="btn btn-success">Sing in</button>
    </div>
        </form>
  </body>
</html>



<!--
if($_POST){
          $name = $_POST["name"];
          if($_POST["name"] == "") {
            $error .= "</br>anun chka";
          }
          if ($_POST["surname"] == "") {
            $error .= "</br>azganun chka";
          }
          if ($_POST["login"] == "") {
            $error .= "</br>login chka";
          }
          if ($_POST["password"] == "") {
            $error .= "</br>password chka";
          }
        }
karmir border 

if(isset($_POST["reg"]) && $_POST['name'] == '')
                    {
                        echo 'error_class';
                    }


      -->




// home 

<?php 
    session_start();
            $host = 'localhost'; // адрес сервера 
            $database = 'pargev'; // имя базы данных
            $user = 'Pargev'; // имя пользователя
            $password = '1234'; // пароль
            $connection = mysqli_connect($host, $user, $password, $database);
    if (!isset($_SESSION['users'])) {
        header("Location:index.php");
    }
    $user_id = $_SESSION['users']['id'];
    $name = $_SESSION['users']['name'];
    $surname = $_SESSION['users']['surname'];
    $gender = $_SESSION['users']['gender'];
    $profil_img = $_SESSION['users']["profil_img"];
    if ($profil_img == "") {
        $img = "$gender";
    }
     $delete = mysqli_query($connection,"update users set profil_img = '' where id = '$user_id'");
    if (isset($_FILES['image']) && isset($_POST["imgUpload"]) && $_FILES['image']['name']) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
//      $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
        $file_names = $_FILES['image']['name'];
        $array = explode('.',$file_names);
        $file_format = end($array);
        $expensions = ['jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'];
        $src = 'images/'.$file_name;
//      var_dump($src);
//      if ($file_size> 2097152) {
//          $errors[] = '2mb ic qich'; 
//      }
        if (empty($errors) == true) {
            if (!file_exists("images/$user_id")) {
                mkdir("images/$user_id");
            }
            if($profil_img){
                unlink($profil_img);
            }
            $profil_img = "images/$user_id/".$file_names;
            move_uploaded_file($file_tmp, $profil_img);
            $_SESSION['users']["profil_img"] = $profil_img; 
            $update = mysqli_query($connection,"update users set profil_img = '$profil_img' where id = '$user_id'");
            echo 'success';
        }
        else {
            print $errors;
        }
    }
    if (isset($_POST["deleteImg"]) && $profil_img){
            if(file_exists($profil_img));
                unlink($profil_img);
                $_SESSION['users']["profil_img"] = "";
        }
        if (isset($_POST["createAlbum"])) {
            header("Location:album.php");
            if (isset($_POST['textName'])) {
            $textName = $_POST["textName"];
        }
            if (!file_exists("images/$user_id")) {
                mkdir("images/$user_id");   
            }
            if (file_exists("images/$user_id")) {
                mkdir("images/$user_id/" . $textName);
            }
        }

/*  if ($gender == 0) {
        $img = "img/man.jpg";
    }
    else {
        $img = "img/woman.jpeg";
    }

    if (isset($_FILES['image'])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

        $expensions = array("jpeg","jpg","png")

        if ($file_size> 2097152) {
            $errors[] = '2mb ic qich' 
        }
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp,"images/".file_name);
            echo 'success';
        }
        else {
            print $errors;
        }
    }
*/  
?>
<html>
    <head>
        <title>home</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        
        <div>
            <?php
                echo  $name, "</br>",  $surname;
            ?>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="image">
            <div class="img">
            <img src="<?php 
                if ($profil_img == "") {
                        echo "img/" . $img . ".jpg";
                    }   
                    else {
                        echo $profil_img;
                    }
                    
                ?>"  height="200" width="200">
<!--                <img src = '<?php //echo $src; ?>' width = '200px'> -->
        </div>
            <input type = "submit" name = "imgUpload" value = "Отправить">
            <input type = "submit" name = "deleteImg" value = "Delete"> 
        </form>
        <form action="" method="POST" class="form-horizontal">
            <input type = "submit" name = "createAlbum" value = "создать альбом">
            <input type = "text" name = "textName">
        </form>
        <a href="logout.php">LogOut</a>
    </body>
</html>
                        

// logaut 

<?php 
    session_start();
    unset($_SESSION['users']); //jnjeci sessian
    header("Location:index.php"); 

?>

// css

.form_main {
    width: 500px;
    margin:150px auto;
}

.error_class {
    border: 1px solid red;
    border-radius: 5px;
    padding: 0;
}

.img {
    width: 200px;
    height: 200px;
    float: left;
    margin-right: 40px;
    border: 5px solid grey;
}



if (!$('.all_checkbox').is(':checked')) {
        $('.checkbox_album').removeAttr('checked');
    }
    else {
        $(".checkbox_album").prop("checked","checked");
    }



    $('#all_checkbox').click(function(){
    if (!$('#all_checkbox').is(':checked')) {
        $('.checkbox_album').removeAttr('checked');
    }
    else {
        $('.checkbox_album').prop('checked','checked');
    }
});

$('#Check_all').click(function(){
    var check_all = document.getElementById('Check_all');
    if(check_all.checked == true){
         check_box_arr = document.getElementsByClassName('myCheck');
        console.log(check_box_arr);
        for(i=0; i < check_box_arr.length; i++ ){
            console.log(check_box_arr[i])
             check_box_arr[i].checked = true; 
        }
    }
    else{
        for(i=0; i < check_box_arr.length; i++ ){
            console.log(check_box_arr[i])
             check_box_arr[i].checked = false; 
        }
    }
})


if ($('.checkbox_album').attr('checked')) {
        for (i = 0; i < .length; i++) {
            
            $.ajax({
                url: ''
            })
        };
    };
    check_box_arr = document.getElementsByClassName('myCheck');
    for(i=0; i < check_box_arr.length; i++ ){
             if(check_box_arr[i].checked == true){
                 album_id = check_box_arr[i].getAttribute('data-album-id');
                 del_icon = check_box_arr[i];       
                 $.ajax({
                    url:'delete.php',
                    type:'post',
                    data:{del_album_id:album_id },
                    success:function(res){
                        if(res==0){
                            alert('your album havent been deleted');
                        }
                        else if(res==1){
                            del_icon.parent().fadeOut(500,function(){
                                $(this).remove();
                            });
                        }
                    }
                })
             }
        }
    

    $('.del').click(function(){
    checkbox_CN = document.getElementsByClassName('checkbox_album');
    for (i=0; i < checkbox_CN.length; i++) {
            if (checkbox_CN[i].checked == true) {
                album_id = checkbox_CN[i].getAttribute('data-album-id');
                del_icon = checkbox_CN[i];
                $.ajax({
                    url : 'del_album.php',
                    type : 'post',
                    data : {a_id : album_id},
                    success:function(x) {
                        if (x == 0) {
                            alert('chi jnjve')
                        }
                        else if (x == 1) {
                            del_icon.parent().fadeOut(500,function(){
                                $(this).remove();
                            });
                        };
                    }
                })
            };
    };

})


// index.php 


<?php
//          require('header.php');
            require_once('con.php');
            $error = "";
if (isset($_POST['reg1'])) {
    $login = $_POST["login"];
    $password = $_POST["password"];
    if($login && $password){
        $obj = mysqli_query($connection,"SELECT * FROM users WHERE login = '$login' AND password = '$password'");
        if (mysqli_num_rows($obj) == 0) {
            $error = "login@ kam password@ sxala";
        }
        else {
            $fetch = mysqli_fetch_assoc($obj);
            $_SESSION['users'] = $fetch;
            header("Location:home.php");
        }
    }
}
?>
<html>
    <head>
        <title>php</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body> 
     <div  class="error">
        <?php
            echo $error;
        ?>
    </div>
        </form>
        <form action="" method="POST" class="form-horizontal form_main">
            <div class="form-group">
                <label for="inputLogin" class="col-md-2 control-label">Login</label>
                <div class="col-md-10">
                    <input type="text" name="login" class="form-control 
                        <?php if(isset($_POST["reg1"]) && $_POST['login'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputLogin" placeholder="Login:">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-md-2 control-label">Password</label>
                <div class="col-md-10">
                    <input type="password" name="password" class="form-control
                        <?php if(isset($_POST["reg1"]) && $_POST['password'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputPassword" placeholder="Password:">
                </div>
            </div>
            <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" name="reg1" class="btn btn-success reg1">Sing in</button>
      <button type="submit" name="reg1" class="btn btn-primary"><a href="registre.php" style="color:#fff">registre</a></button>
    </div>
        </form>


<?php
   require('footer.php');
?> 

<!--
if($_POST){
                $name = $_POST["name"];
                if($_POST["name"] == "") {
                    $error .= "</br>anun chka";
                }
                if ($_POST["surname"] == "") {
                    $error .= "</br>azganun chka";
                }
                if ($_POST["login"] == "") {
                    $error .= "</br>login chka";
                }
                if ($_POST["password"] == "") {
                    $error .= "</br>password chka";
                }
            }
karmir border 

if(isset($_POST["reg"]) && $_POST['name'] == '')
                    {
                        echo 'error_class';
                    }


        -->
<!-- 
                       <?php if(isset($_POST["reg1"]) && $_POST['login'] == '')
                            {
                                echo 'error_class';
                        }
                ?>
-->   

                        <?php if(isset($_POST["reg1"]) && $_POST['password'] == '')
                            {
                                echo 'error_class';
                        }
                ?>



// registre 


<?php
//          require('header.php');
            require_once('con.php');
            $error = "";
            $profil_img = "";
            $registred = false;
            if(isset($_POST["reg"])){
                $name = $_POST["name"];
                $surname = $_POST["surname"];
                $login = $_POST["login"];
                $password = $_POST["password"];
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
                  $select = "SELECT login FROM users WHERE login = '$login'";
                  $result = mysqli_query($connection, $select);
                  if (mysqli_num_rows($result) != 0) {
                      echo "tenc login ka";
                  }
                  else{
                $sql = "INSERT INTO users (name, surname, login, password, gender, profil_img) VALUES ('$name', '$surname', '$login', '$password', '$gender', '')";
                if(mysqli_query($connection, $sql)){
//                 $_POST = [];
//header("Location: home.php");
//home.php
                   //echo "duq grancvel eq";
                    $name = "";
                    $surname = "";
                    $login = "";
                    $registred = true;
                    header("Location:index.php");
                    } 
                }
            }
}
?>
<html>
    <head>
        <title>php</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body> 
        <form action="" method="POST" class="form-horizontal form_main">
            <div class="form-group">
                <label for="inputName" class="col-md-2 control-label">Name</label>
                <div class="col-md-10">
                    <input type="text" name="name" value="<?php if (isset($_POST['reg']) && !empty($name)) {
                        $registred = false;
                        echo $name;
                    } ?>" class="form-control 
                        <?php if(isset($_POST["reg"]) && $_POST['name'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputName" placeholder="Name:">
                </div>
            </div>
            <div class="form-group">
                <label for="inputSurname" class="col-md-2 control-label">Surname</label>
                <div class="col-md-10">
                    <input type="text" name="surname" value="<?php if (isset($_POST['reg']) && !empty($surname)) {
                        $registred = false;
                        echo $surname;
                    } ?>" class="form-control 
                        <?php if(isset($_POST["reg"]) && $_POST['surname'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputSurname" placeholder="Surname:">
                </div>
            </div>
            <div class="form-group">
                <label for="inputLogin" class="col-md-2 control-label">Login</label>
                <div class="col-md-10">
                    <input type="text" name="login" value="<?php if (isset($_POST['reg']) && !empty($login)) {
                        $registred = false;
                        echo $login;
                    } ?>" class="form-control
                         <?php if(isset($_POST["reg"]) && $_POST['login'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputLogin" placeholder="Login:">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-md-2 control-label">Password</label>
                <div class="col-md-10">
                    <input type="password" name="password" class="form-control
                        <?php if(isset($_POST["reg"]) && $_POST['password'] == '')
                            {
                                echo 'error_class';
                        }
                ?>" id="inputPassword" placeholder="Password:">
                </div>
            </div>
            <label class="radio-inline">
                <input type="radio" name="radio_gender" value = 'men' checked>  Men
            </label>
            <label class="radio-inline">
                <input type="radio" name="radio_gender" value = 'women'>Women
            </label>
            <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="reg" class="btn btn-success">registre</button>
      <button type="submit" name="reg" class="btn btn-primary"><a href="index.php" style="color:#fff">log in</a></button>
    </div>
     <div  class="error">
        <?php
            echo $error;
        ?>
    </div>
  </div>
        </form>
<?php
   require('footer.php');
?> 





<?php 
    if ($homeBg != '') {
        echo '<button id="DelCoverImg" type="button" class="deleteCover deleteImg">DELETE COVER PHOTO</button>';
    }
?>



<?php 
        if ($profil_img != '') {
          echo '<button id="DelProfileImg" type="button" class="deleteImg">DELETE PROFILE PHOTO</button>';
        }
      ?>






 <!--   1       <img src = '<?php //echo $src; ?>' width = '200px'> -->
 <!-- 2   <input type="file" name="input-file" id="input-file"> -->

<!--   

<?php
//    while ($fetch = mysqli_fetch_assoc($post_result)) {
//                echo '<tr>
//                  <td data-toggle="modal" data-target="#myModal" class="edit"><span class="glyphicon glyphicon-pencil btn btn-info btn-lg" 
//                  data-album-id = '.$fetch["id"].'><img class="append_post_img" src=" <?php

                   ?>" height="790px" width="700px"></span></td>
                  <td><span class="glyphicon glyphicon-remove remove_album" data-album-id = '.$fetch["id"].'></span></td> 
                </tr>';
    };
  ?>























   '<tr>
                  <td class="arm_name">'.$fetch["arm_name"].'</td>
                  <td class="eng_name">'.$fetch["eng_name"].'</td>
                  <td data-toggle="modal" data-target="#myModal" class="edit"><span class="glyphicon glyphicon-pencil btn btn-info btn-lg" 
                  data-album-id = '.$fetch["id"].'></span></td>
                  <td><span class="glyphicon glyphicon-remove remove_album" data-album-id = '.$fetch["id"].'></span></td> 
                  <td><input type="checkbox" class = "checkbox_album" name="checkbox_album" data-album-id = '.$fetch["id"].'></td>
                </tr>';
  <button type='button'> add post</button>
 <div>
      <?php
//      echo  $name, "</br>",  $surname;
      ?>
    </div> -->
<!--    <form action="" method="POST" enctype="multipart/form-data" class = 'main'>
      <input type="file" name="image">
      <div class="img">
      <img src="<?php 
//        if ($profil_img == "") {
//            echo "img/" . $img . ".jpg";
//          } 
//          else {
//            echo $profil_img;
//          }
          
        ?>"  height="200" width="200">
1
    </div>
2
      <input type = "submit" name = "deleteImg" value = "Delete">
      <input type = "submit" name = "imgUpload" value = "Отправить"> 
    </form>  -->

          else if (mysqli_num_rows($obj) == 2) {
            $_SESSION['users']['name'] = $name;
            $_SESSION['users']['surname'] = $surname;
            $_SESSION['users']['gender'] = $gender;
            $sql =  mysqli_query($con,"update users set name = '$name', surname = '$surname', login = '$login', password = '$password', gender = '$gender' where id = '$user_id'");
              echo 2;
          }


if (isset($_POST['type']) && $_POST['type'] == 'profile_img') {
      if (assayImg() == true) {
            echo 1;   
          }
          else {
            echo 0;
          }
    }
    else if (isset($_POST['type']) && $_POST['type'] == 'cover_img') {
      if (assayImg() == true) {
            echo 1;   
          }
          else {
            echo 0;
          }
    }
  } 



isset($_POST['type']) && $_POST['type'] == 'profileUpload'
<!--
  if ($_POST['type'] == 'profile') {

    if ($_FILES['file']['error'] != 0) {
      echo 0;
    }
    else {
      if (assayImg() == true) {
        echo 1;   
      }
      else {
        echo 0;
      }
    }
  }
  if ($_POST['type'] == 'profileUpload') {
    if ($_FILES['file']['error'] != 0) {
      echo 0;
    }
    else{
      if (assayImg() == true) {
        if (!file_exists("images/$user_id")) {
            mkdir("images/$user_id");
        }
        if($profil_img){
          unlink($profil_img);
        }
        $profil_img = "images/$user_id/".$file_name;
        move_uploaded_file($file_tmp, $profil_img);
        $_SESSION['users']["profil_img"] = $profil_img; 
        $update = mysqli_query($con,"update users set profil_img = '$profil_img' where id = '$user_id'");
        if ($update) {
          echo $profil_img;
        }
        else {
          echo 2;
        }
      }
      else {
        echo 0;
      }
    }
  }
  if (isset($_POST['delet'])) {
    $delet = $_POST['delet'];
    if(file_exists($profil_img)){
          unlink($profil_img);
        $_SESSION['users']["profil_img"] = "";
      }
  }
  if ($_POST['type'] == 'cover_img') {

    if ($_FILES['file']['error'] != 0) {
      echo 0;
    }
    else {
      if (assayImg() == true) {
        echo 1;   
      }
      else {
        echo 0;
      }
    }
  }
  -->




















<div class="home_bg">
  <img src="<?php
      if ($homeBg == '') {
          echo 'img/fox2.jpg';
        }
        else {
          echo $home_bg;
        }?>"
    >
</div>




//form Submit
   $("form").submit(function(evt){	 
      evt.preventDefault();
      var formData = new FormData($(this)[0]);
   $.ajax({
       url: 'fileUpload',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
       success: function (response) {
         alert(response);
       }
   });
   return false;
 });

// home php
//  $user_id = $_SESSION['users']['id'];
//  $name = $_SESSION['users']['name'];
//  $surname = $_SESSION['users']['surname'];
//  $gender = $_SESSION['users']['gender'];
//  $profil_img = $_SESSION['users']["profil_img"];
//  if ($profil_img == "") {
//    $img = "$gender";
//  }
    $homeBg = $_SESSION['users']['homeBg'];
  $delete = mysqli_query($con,"update users set profil_img = '' where id = '$user_id'");
  if (isset($_FILES['image']) && isset($_POST["imgUpload"]) && $_FILES['image']['name']) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
//    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
    $file_names = $_FILES['image']['name'];
    $array = explode('.',$file_names);
    $file_format = end($array);
    $expensions = ['jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'];
    $src = 'images/'.$file_name;
//    var_dump($src);
//    if ($file_size> 2097152) {
//      $errors[] = '2mb ic qich'; 
//    }
    if (empty($errors) == true) {
      if (!file_exists("images/$user_id")) {
        mkdir("images/$user_id");
      }
      if($profil_img){
        unlink($profil_img);
      }
      $profil_img = "images/$user_id/".$file_names;
      move_uploaded_file($file_tmp, $profil_img);
      $_SESSION['users']["profil_img"] = $profil_img; 
      $update = mysqli_query($con,"update users set profil_img = '$profil_img' where id = '$user_id'");
//      echo 'success';
    }
    else {
//      print $errors;
    }
  }
  if (isset($_POST["deleteImg"]) && $profil_img){
      if(file_exists($profil_img)){
          unlink($profil_img);
        $_SESSION['users']["profil_img"] = "";
      }
      header("Location:home.php");
    }
//    
    $deleteHomeBg = mysqli_query($con,"update users set $homeBg = '' where id = '$user_id'");
    if (isset($_FILES['image']) && isset($_POST["imgUploadH"]) && $_FILES['image']['name']) {
    $errorsH = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
//    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
    $file_names = $_FILES['image']['name'];
    $array = explode('.',$file_names);
    $file_format = end($array);
    $expensions = ['jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'];
    $src = 'images/'.$file_name;
//    var_dump($src);
//    if ($file_size> 2097152) {
//      $errors[] = '2mb ic qich'; 
//    }
    if (empty($errorsH) == true) {
      if (!file_exists("images/$user_id")) {
        mkdir("images/$user_id");
      }
      if($homeBg){
        unlink($homeBg);
      }
      $home_bg = "images/$user_id/".$file_names;
      move_uploaded_file($file_tmp, $homeBg);
      $_SESSION['users']["homeBg"] = $homeBg; 
      $update = mysqli_query($con,"update users set homeBg = '$homeBg' where id = '$user_id'");
//      echo 'success';
    }
    else {
//      print $errors;
    }
  }
  if (isset($_POST["deleteImgH"]) && $homeBg){
      if(file_exists($homeBg)){
          unlink($homeBg);
        $_SESSION['users']["homeBg"] = "";
      }
      header("Location:home.php");
    }
/*  if ($gender == 0) {
    $img = "img/man.jpg";
  }
  else {
    $img = "img/woman.jpeg";
  }

  if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    $expensions = array("jpeg","jpg","png")

    if ($file_size> 2097152) {
      $errors[] = '2mb ic qich' 
    }
    if (empty($errors) == true) {
      move_uploaded_file($file_tmp,"images/".file_name);
      echo 'success';
    }
    else {
      print $errors;
    }
  }
*/


// cover img 


<div class="bg_home_img">
  <img src="<?php
      if ($homeBg == '') {
        echo 'img/fox2.jpg';
      }
      else {
        echo $home_bg;
      }
  ?>" class="bg_home">
  <input type = "submit" name = "imgUploadH" value = "Отправить">
  <input type = "submit" name = "deleteImgH" value = "Delete">
</div>



// form data 


var form = $('#form_name')[0]; 
        var formData = new FormData(form);
        for (var [key, value] of formData.entries()) { 
            console.log(key, value);
        }
        $.ajax({
            type: "POST",
            url: " ",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function() {

            },
            success: function(data) {


            },

       });


if ($profil_img == "") {
            echo "img/" . $img . ".jpg";
          } 
          else {
            echo $profil_img;
          }









function abc(){ 
    var form = $('#form_name')[0]; 
        var formData = new FormData(form);
        for (var [key, value] of formData.entries()) { 
            console.log(key, value);
        }
        $.ajax({
            type: "POST",
            url: " ",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function() {

            },
            success: function(data) {


            },

       });
}















$('.input_img').change(function(){
        var formData = new FormData();
        formData.append('file','name');
        formData.append('type','format');
        $('.input_img').prop('files')[0];
        $.ajax({
            type: "POST",
            url: "change_img.php",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {
            }

       })
})







<html lang="en">
<head>
    <title>Change image on select new image from file input</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>
<body>


<input type="file" name="file" id="profile-img">
<img src="" id="profile-img-tag" width="200px" />


<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
</script>


</body>
</html>


App.Dispatcher.on("uploadpic", function() {         
        $(":file").change(function() {
            if (this.files && this.files[0] && this.files[0].name.match(/\.(jpg|jpeg|png|gif)$/) ) {
                if(this.files[0].size>1048576) {
                    alert('File size is larger than 1MB!');
                }
                else {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            } else alert('This is not an image file!');
        });
        function imageIsLoaded(e) {
            result = e.target.result;
            $('#image').attr('src', result);
        };
    });
