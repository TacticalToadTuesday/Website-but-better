<?php
   include('security.php');
   require "database/dbconfig.php";
   require "database/makedatabases.php";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Messages</title>
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
                           <li><a href="friends.php">Friends</a></li>
                           <li class="active"><a href="messages.php">Messages</a></li>
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
      <style>
         .presonWrapper{
            width: 20%;
            min-width: 150px;
            height: 85vh;
            padding-left: 10px;
            padding-right: 10px;
            border-right: 2px solid gray;
         }
         .presonWrapper a{
            text-decoration: none;
         }
         .presonWrapper li {
            list-style-type: none;
         }
         .presonWrapper img{
            margin-top:20px;
            margin-bottom:20px;
            margin-left:20px;
            width: 75px;
            height: 75px;
            border-radius:50%;
         }

         .person:hover{
            background-color: #0099ff;
            border-radius: 20px;
         }
         
         .name{
            font-weight: bold;
            padding-left: 20px;
            text-decoration: underline;
         }
         .personWrapper, .Messages {
            display: inline-block;
            display: flex;
            justify-content: center;
         }
      </style>
      <div class="PageWrapper">
      <div class="presonWrapper" style="float:left; overflow:auto;">
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
            echo '</div><div class="alert alert-warning" role="alert" style="text-align:center; width: 40%; margin:auto; font-weight: bold;">You have not added any friends</div>';
         }

         if($query_run){
            
            $person_index = 1;
            foreach($query_run as $row){
               $sql_pro_pic = "SELECT profilePic FROM `accounts` WHERE username = '{$row['Friends']}'";
               $query_run_pro_pic = mysqli_query($connect, $sql_pro_pic);
               $profilepic = mysqli_fetch_row($query_run_pro_pic);

               
               $userurl = 'user.php?username='.$row['Friends'].'';
               echo "<a href='?user={$row['Friends']}'><li class='person' data-chat='person$person_index'>
                        <img src='/ProfilePics/$profilepic[0]' alt='{$row['Friends']} Profile Picture' />
                        <span class='name'>{$row['Friends']}:</span>
                     </li></a>
                     <hr style='width:80%;height:2px;border-width:0;color:gray;background-color:gray'>";
               
               $person_index ++;
               
            }
         }else{
            echo "An error has occured please reload the page";
         }
         ?>
      </div>
      <style>
         .Messages{
            margin: auto;
            height: 90vh;
            width: 70%;
         }
         .TextEntry{
            width:100%;
            display: block;
         }
         .TextEntry input{
            width: 40%;
         }
         .messages-Wrapper{
            display: block;
         }
      </style>
      <div class= "Messages">
         <div class="messages-Wrapper">
         <?php
            $uri = $_SERVER['REQUEST_URI'];
            $url_components = parse_url($uri);
            parse_str($url_components['query'], $params);

            $servername = "db";
            $username = "root";
            $password = "root";
            $dbname = "relations";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql_posts = "SELECT `Friends` FROM `{$_SESSION['username']}` WHERE Friends = '".$params['user']."'";
            $result = $conn->query($sql_posts);
            $fetch_sql = mysqli_fetch_row($result);

            if(!$params['user']){
               die;
            }else if (!$fetch_sql) {
               echo '<div class="alert alert-danger" role="alert" style="text-align:center; width: 40%; margin:auto; font-weight: bold;">
                        Unable to load user: You have not added them
                  </div>';
                  $conn->close();
               die;
            }else{
               echo "<h1 style='text-align: center; text-decoration: underline;'>{$params['user']}</h1>";
            }

            $conn->close();
         ?>
         <style>
            /* */
            .Messagebox{
               position: relative;
               width:70vw;
               height: 70vh;
               padding:2px;
               overflow:auto;
            }
            .TextEntry{
               display: flex;
               justify-content: center;
            }
            form{
               position: relative;
               margin: auto;
               width: 70%;
            }
            form input{
            }
         </style>
         <div class="Messagebox">
            <?php
            echo "No messages yet";
            ?>
         </div>


         <form action="" method="post" class="messageText-form">
            <div class="TextEntry">
               <input type="text">
               <button> send </button>
               <button>file</button>
            </div>
         </form>
      </div>
      </div>
   </div>
        
   </body>