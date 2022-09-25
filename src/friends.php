<?php
   include('security.php');
   require "database/dbconfig.php";
   require "database/makedatabases.php";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Add Friends</title>
      <link rel="stylesheet" href="./style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   </head>
   <body>
    <!-- Top navigation -->
    <nav>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <div class="navbar navbar-inverse">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="navbar-header">
                        <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                        <a href="#" class="navbar-brand">UnNamed</a>
                     </div>
                     <div class="navbar-collapse collapse" id="mobile_menu">
                        <ul class="nav navbar-nav">
                           <li><a href="index.php">Home</a></li>
                           <!-- <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                 <li><a href="#">About One</a></li>
                                 <li><a href="#">About Two</a></li>
                                 <li><a href="#">About Three</a></li>
                                 <li><a href="#">About Four</a></li>
                                 <li><a href="#">About Five</a></li>
                                 <li><a href="#">About Six</a></li>
                              </ul>
                              </li> -->
                           <li class="active"><a href="friends.php">Friends</a></li>
                           <li><a href="messages.php">Messages</a></li>
                           <!-- <li><a href="addfriends.php">Add Friends</a></li>
                            <li><a href="#">Contact Us</a></li> -->
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                           <li>
                              <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username'];?><span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                 <li><a href="profile.php">Profile</a></li>
                                 <li><a href="addfriends.php">Add Friends</a></li>
                                 <li><a href="settings.php">Settings</a></li>
                                 <li><a href="logout.php">Sign Out</a></li>
                              </ul>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      </nav>
    
        <?php
            $servername = "db";
            $username = "root";
            $password = "root";
            $dbname = "relations";

            $connect_friends = mysqli_connect($servername,$username,$password,$dbname);
            $sql = "SELECT * FROM `{$_SESSION['username']}`";

            $query_run = mysqli_query($connect_friends, $sql);
            $fetch_sql = mysqli_fetch_row($query_run);

            if(!$fetch_sql){
               echo '<div class="alert alert-warning" role="alert">You have not added any friends</div>';
            }

            if($query_run){
               
                  echo '<div class="usersWrapper">';
                  foreach($query_run as $row){
                     $sql_pro_pic = "SELECT profilePic FROM `accounts` WHERE username = '{$row['Friends']}'";
                     $query_run_pro_pic = mysqli_query($connect, $sql_pro_pic);
                     $profilepic = mysqli_fetch_row($query_run_pro_pic);

                     $userurl = 'user.php?username='.$row['Friends'].'';
                     echo '<div class="user_box">
                              <div class="user_info"><span>'.$row['Friends'].'</span>
                              <div class="user_img"><img src="./ProfilePics/'.$profilepic[0].'" alt="Unable to Retrieve Profile Picture"></div>
                              <span><a href="'.$userurl.'" class="see_profileBtn">See profile</a></div>
                        </div>';
                     
                  }
                  echo '</div>';
            }else{
               echo "An error has occured please reload the page";
            }
        ?>
    

        
      
      

   </body>
</html>
