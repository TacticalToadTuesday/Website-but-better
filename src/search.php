<?php
   include('security.php');
   require "database/dbconfig.php";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Search</title>
      <link rel="stylesheet" href="style.css">
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
                           <li class="active"><a href="index.php">Home</a></li>
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
                           <li><a href="messages.php">Messages</a></li>
                           <!-- <li><a href="#">Gallery</a></li>
                              <li><a href="#">Contact Us</a></li> -->
                        </ul>
                        <ul class="nav navbar-nav">
                           <li>
                              <form action="" method="post" class="navbar-form">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="search" name="search" id="" placeholder="Search For Users" class="form-control">
                                       <span class="input-group-addon"><button type="submit" name="searchbtn" class="glyphicon glyphicon-search" style="border:none"></button></span>
                                    </div>
                                 </div>
                              </form>
                           </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                           <li>
                              <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username'];?><span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                 <li><a href="profile.php">Profile</a></li>
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
         <div class="usersWrapper">
            <?php
            
               if(isset($_POST['searchbtn'])){
               $searchuser = $_POST['search'];
               $query_url = 'search.php?q='.$searchuser.'';
               header('Location:'.$query_url.'');
               }
       
               $uri = $_SERVER['REQUEST_URI'];
               $url_components = parse_url($uri);
               parse_str($url_components['query'], $params);
       
               if ($params['q'] == ""){
                   die;
               }else{
                   $query = "SELECT * FROM `accounts` WHERE username LIKE '{$params['q']}%'";
                   $query_run = mysqli_query($connect, $query);
                   if($query_run){
                       foreach($query_run as $row){
                           $userurl = 'user.php?username='.$row['username'].'';
                           echo '<div class="user_box">
                                   <div class="user_info"><span>'.$row['username'].'</span>
                                   <div class="user_img"><img src="./ProfilePics/'.$row['profilePic'].'" alt="Unable to Retrieve Profile Picture"></div>
                                   <span><a href="'.$userurl.'" class="see_profileBtn">See profile</a></div>
                               </div>';
       
                           
                       }
                       if ($row == ""){
                           echo "<h1 style='text-align:center'>User Not Found</h1>";
                       }
                   }
                   else{
                       echo '<h4>There is no users!</h4>';
                   }
               }
               ?>
         </div>
      </nav>


        
      
      

   </body>
</html>
