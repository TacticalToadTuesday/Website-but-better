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
                           <li><a href="messages.php">Messages</a></li>
                           <!-- <li><a href="addfriends.php">Add Friends</a></li>
                            <li><a href="#">Contact Us</a></li> -->
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                           <li class="active">
                              <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username'];?><span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                 <li><a href="profile.php">Profile</a></li>
                                 <li class="active"><a href="addfriends.php">Add Friends</a></li>
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
         $query = "SELECT `Code`, `ID` FROM `userfriendcodes` WHERE ID = '{$_SESSION['acc_id']}'";
         $query_run = mysqli_query($connect, $query);
         
         if($query_run){
             foreach($query_run as $row){
                if ($row['ID'] == $_SESSION['acc_id']) {
                   $q_delete = "DELETE FROM `userfriendcodes` WHERE id = '{$_SESSION['acc_id']}'";
                   $query_run_delete = mysqli_query($connect, $q_delete);
                   $found = 1;
                }
          }
         }
         
         
         $code = sprintf("%06d", mt_rand(1, 999999));
         echo "<h1 class='code'>$code</h1>";
         
         $query_insert = "INSERT INTO `userfriendcodes` (`Code`, `ID`) VALUES ('{$code}','{$_SESSION['acc_id']}')";
         $query_run_insert = mysqli_query($connect, $query_insert);
         ?>
      <style>
         .UserEnterCode{
         width: 200px;
         }
         .code{
            text-align: center;
         }
         .EnterCodeDiv{
            text-align: center;
         }
      </style>
      <form action="" method="post" class="addfriend-form">
         <div class="EnterCodeDiv">
            <input type="number" name="entercode" id="" placeholder="Enter Anothers Users Code" class="UserEnterCode">
            <button type="submit" name="addUser" class="btn btn-outline-primary">Add User</button>
         </div>
      </form>
      <?php
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

                        // sql to create table
         $sql = "CREATE TABLE IF NOT EXISTS `{$_SESSION['username']}` (
            Friends varchar(255),
            add_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);";

         $conn->query($sql);   
         $conn->close();

         if(isset($_POST['addUser'])){
            $query = "SELECT `ID` FROM `userfriendcodes` WHERE Code = '{$_POST['entercode']}'";
            $query_run= mysqli_query($connect, $query);
            $result = mysqli_fetch_row($query_run);

            if(!$result){
               echo '<br>
                     <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong> Could not find the user.
                     </div>';
            }else{
               $query_name = "SELECT username FROM `accounts` WHERE id = '{$result[0]}'";
               $query_run_name= mysqli_query($connect, $query_name);
               $useradded = mysqli_fetch_row($query_run_name);

               $servername = "db";
               $username = "root";
               $password = "root";
               $dbname = "relations";
               $dbname_accounts = "accounts";
               
               // Create connection
               $conn = new mysqli($servername, $username, $password, $dbname_accounts);
               // Check connection
               if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
               }   
               
               $sql = "INSERT INTO `requests` (`sender`, `receiver`) VALUES ('{$_SESSION['username']}','{$useradded['0']}')";
               $conn->query($sql);
               $conn->close();
               
               //$sql_user = "INSERT INTO {$useradded['0']} (`Friends`) VALUES ('{$_SESSION['acc_id']}')";
               //$conn->query($sql_user);

               //$sql = "INSERT INTO {$_SESSION['username']} (`Friends`) VALUES ('{$result[0]}')";
               //$sql_user = "INSERT INTO {$useradded['0']} (`Friends`) VALUES ('{$_SESSION['acc_id']}')"
               //$conn->query($sql);
               //$conn->query($sql_user);
               //$conn->close();
               
               //Displays Success message when user is added.
               echo '<div class="alert alert-success" role="alert" style="text-align:center; width: 40%; margin:auto; font-weight: bold; margin-top:20px;">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        Added User <strong>'.$useradded['0'].'</strong>
                     </div>';
            }
         }

      ?>
      <hr style="width:80%;height:2px;border-width:0;color:gray;background-color:gray">
      <div class="usersWrapper">
   <?php
         $q_check_added = "SELECT `sender` FROM `requests` WHERE receiver = '{$_SESSION['username']}'";
         $query_run_added= mysqli_query($connect, $q_check_added);

         if($query_run_added){
            foreach($query_run_added as $row){


               //get user profile pic
               $sql_pro_pic = "SELECT profilePic FROM `accounts` WHERE username = '{$row['sender']}'";
               $query_run_pro_pic = mysqli_query($connect, $sql_pro_pic);
               $profilepic = mysqli_fetch_row($query_run_pro_pic);

               // Displays users atempted to add
               echo '<form method="POST" action="" id="addFriend" enctype="multipart/form-data">
                        <div class="user_box">
                           <div class="user_info"><span>'.$row['sender'].'</span>
                           <div class="user_img"><img src="./ProfilePics/'.$profilepic['0'].'" alt="Unable to Retrieve Profile Picture"></div>
                           <br>
                           <button type="submit" name="'.$row['sender'].'">Add Friend</button></div>
                        </div>
                     </form>';

               if(isset($_POST[$row['sender']])){
                  $query_add = "DELETE FROM `requests` WHERE sender = '{$row['sender']}' AND receiver = '{$_SESSION['username']}'";
                  $query_run_add= mysqli_query($connect, $query_add);


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
                  
                  $sql = "INSERT IGNORE INTO `{$_SESSION['username']}` (`Friends`) VALUES ('{$row['sender']}')";
                  $sql_user = "INSERT IGNORE INTO `{$row['sender']}` (`Friends`) VALUES ('{$_SESSION['username']}')";
                  $conn->query($sql);
                  $conn->query($sql_user);
                  $conn->close();
                  
                  //$sql_user = "INSERT INTO {$useradded['0']} (`Friends`) VALUES ('{$_SESSION['acc_id']}')"
                  //$conn->query($sql);
                  //$conn->query($sql_user);
                  //$conn->close();
                  //bazinga
                  
               }
               
            }

           
      }else{
         echo "You have no pending friend requests";
      }
   ?>
   </div>
   </body>
</html>