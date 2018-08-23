<?php
	session_start();
  require_once('con.php');
	if (!isset($_SESSION['users'])) {
    header("Location:index.php");
  	}	
	$user_id = $_SESSION['users']['id'];
	$name = $_SESSION['users']['name'];
	$surname = $_SESSION['users']['surname'];
	$gender = $_SESSION['users']['gender'];
	$profil_img = $_SESSION['users']['profil_img'];
  $login = $_SESSION['users']['login'];
  $passwordProf = $_SESSION['users']['password'];
  $homeBg = $_SESSION['users']['homeBg'];
	if ($profil_img == "") {
		$src = "img/" . "$gender" . ".jpg";
	}
	else {
		$src = $profil_img;

	}

	$name = $_SESSION['users']['name'];
  $surname = $_SESSION['users']['surname'];

  $select_friend = mysqli_query($con,"SELECT * FROM friends WHERE fr_id ='$user_id' and friend  = 0");
    $users = [];
    while ($fetch_friend = mysqli_fetch_assoc($select_friend)) {
      $user = mysqli_query($con,"SELECT * FROM users WHERE id = ".$fetch_friend['us_id']."");
      $users[] = mysqli_fetch_assoc($user);  
    } 
    if (isset($_POST['addFriend']) && isset($_POST['id_user'])) {
        $us_id = $_POST['id_user'];
        $update = mysqli_query($con,"update friends set friend = 1 where fr_id = '$user_id' and us_id = '$us_id'");
    }
    if (isset($_POST['ignFriend']) && isset($_POST['id_user'])) {
        $us_id = $_POST['id_user'];
        $update = mysqli_query($con,"update friends set friend = 2 where fr_id = '$user_id' and us_id = '$us_id'");
    }

    $usersCount = count($users);
//    var_dump($usersCount);die;
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<nav class="navbar navbar-inverse nav_main">
  			<div class="container-fluid">
  				<div class="box_ball">
  					<img  class='header_img' src="<?php 
						echo $src;
				?>" height="100px" width="100px" class="img_pro">
  				</div>
    			<div class="navbar-header">
      				<a class="navbar-brand" href="home.php">
                <span class='top_name'><?php
                        echo $name;
                  ?></span>
                  <span class='top_surname'>
                    <?php
                        echo $surname;
                    ?>
                  </span>
            		</a>
    			</div>
    				<ul class="nav navbar-nav">
      					<li><a href="home.php">Home</a></li>
      					<li><a href="album.php">albums</a></li>
                <li><a href="edit_profile.php">edit_profile</a></li>
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
                <input type="text" name="search" class="searchName" id="search" placeholder="Search for names..">
                <div class='search_div'></div>
    				</ul>
    				<ul class="nav navbar-nav navbar-right">
    					<li class="fox_logo"></li>
      					<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>  log Out</a></li>
    				</ul>
 		 	</div>
		</nav>
