<?php
   include('security.php');
   require "database/dbconfig.php";
   require "database/makedatabases.php";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Home</title>
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
                           <!-- <li><a href="addfriends.php">Add Friends</a></li>
                              <li><a href="#">Contact Us</a></li> -->
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                           <li><button class="post-button" id="post-button" onclick="openForm()">Make A Post</button></li>
                           <li>
                              <a href="profile" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username'];?><span class="caret"></span></a>
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
      <div class="MakeAPost">
         <style>
            {box-sizing: border-box;}
            /* Button used to open the contact form - fixed at the bottom of the page */
            .post-button {
            background-color: #333;
            color: white;
            padding:15px;
            border: none;
            cursor: pointer;
            opacity: 1;
            width: 150px;
            }
            /* The popup form - hidden by default */
            .form-popup {
            display: none;
            width: 70%;
            max-width: 500px;
            margin: 0 auto;
            border: 3px solid #f1f1f1;
            }
            /* Add styles to the form container */
            .form-container {
            padding: 10px;
            background-color: white;
            }
            /* Full-width input fields */
            .form-container input[type=text]{
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
            }
            /* Set a style for the submit/login button */
            .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom:10px;
            opacity: 0.8;
            }
            /* Add a red background color to the cancel button */
            .form-container .cancel {
            background-color: red;
            }
            /* Add some hover effects to buttons */
            .form-container .btn:hover, .post-button:hover {
            opacity: 1;
            }
         </style>
         
         <!-- The form -->
         <div class="form-popup" id="myForm">
            <form method="POST" action="" enctype="multipart/form-data" class="form-container">
               <h1>Make A Post:</h1>
               <label for="email"><b>Title:</b></label>
               <input type="text" name="PostTitle" placeholder="Caption Post" name="email" required>
               <h2>Select image to upload:</h2>
               <input type="file" name="fileToUpload" id="fileToUpload" required>
               <br><button type="submit" name="makePost" class="btn">Make Post</button>
               <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
         </div>
         <script>
            function openForm() {
               document.getElementById("myForm").style.display = "block";
               document.getElementById("post-button").style.display = "none";
            }
            
            function closeForm() {
               document.getElementById("myForm").style.display = "none";
               document.getElementById("post-button").style.display = "block";
            }
         </script>
         <?php
            error_reporting(0);
            
            
            // If makePost button is clicked ...
            if(isset($_POST['makePost'])) {
                $filename = $_FILES["fileToUpload"]["name"];
                $tempname = $_FILES["fileToUpload"]["tmp_name"];
               
                if ($_FILES["fileToUpload"]["size"] > 50000000) {
                  echo "Sorry, your file is too large.";
                }else{
                  
                  $temp = explode(".", $_FILES["fileToUpload"]["name"]);
                  $newfilename = round(microtime(true)) . '.' . end($temp);
                  $folder = "./Posts/{$_SESSION['username']}/". $newfilename;
                  
                  $type=$_FILES["fileToUpload"]["type"];     
                  $extensions=array('image/jpeg', 'image/png', 'image/gif', 'image/jpg' );
                  if(in_array( $type, $extensions )){
                     $contents = $newfilename;
                     // Now let's move the uploaded image into the folder: image
                     if (move_uploaded_file($tempname, $folder)) {
                           echo "<h3> Posted successfully!</h3>";
                     } else {
                           echo "<h3> Failed to upload image!</h3>";
                     }   
                     
                     $servername = "db";
                     $username = "root";
                     $password = "root";
                     $dbname = "posts";
                        
                     // Create connection
                     $conn = new mysqli($servername, $username, $password, $dbname);
                     // Check connection
                     if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                     }
                     
                     $sql_posts = "INSERT INTO `{$_SESSION['username']}` (`Title`, `Contents`) VALUES ('{$_POST['PostTitle']}', '$contents')";
                     
                     $conn->query($sql_posts);   
                     $conn->close();
            
            
            
                     //Inserts post into feed
                  
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
                     $sql_friends = "SELECT * FROM `{$_SESSION['username']}`";
                     $result = $conn->query($sql_friends);
                     while($row = $result->fetch_assoc()) {
                        echo $row['Friends'];
                        //$dbname = "Feeds";
                        //$conn = new mysqli($servername, $username, $password, $dbname);
                        //$sql_friends = "INSERT INTO `{$row['Friends']}`(`Poster`, `Title`, `Contents`) VALUES ('{$_SESSION['username']}', '{$_POST['PostTitle']}','$contents')";
                        //echo $sql_friends;
                        //$result = $conn->query($sql_friends);
                        //$conn->close();
            
                        $db_server = "db";
                        $db_username= "root";
                        $db_password = "root";
                        $db_feeds = "feeds";

                        $conn = new mysqli($db_server,$db_username,$db_password, $db_feeds);
                        //$connect = mysqli_connect($db_server,$db_username,$db_password);
                        //$db_config_feed = mysqli_select_db($connect,$db_feeds);

                        //Creates Friend Feed table.
                        $sql_create_tables = "CREATE TABLE IF NOT EXISTS {$row['Friends']} (
                           PostID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                           Poster varchar(255),
                           Title varchar(255),
                           Contents varchar(255),
                           add_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);";
                        
                       
                        //$result_create_table = mysqli_query($connect, $sql);
                        //$result_feeds = mysqli_query($connect, $query_feeds);
                        
                        $query_feeds = "INSERT INTO `{$row['Friends']}`(`Poster`, `Title`, `Contents`) VALUES ('{$_SESSION['username']}', '{$_POST['PostTitle']}','$contents')";
                        $conn->query($sql_create_tables);
                        $conn->query($query_feeds);
                        $conn->close();

                     }
                     $conn->close();
                  }else{
                     echo "<h3>Please upload a valid image (Supported formats include; .jpg .png and .gif)</h3>";
                  }     
               }
            }
            ?>
      </div>
      <h1 style="text-align:center; font-weight:bold;">My Feed:</h1>
      <hr style="width:80%;height:2px;border-width:0;color:gray;background-color:gray">
      <style>
         .PostWrapper{
               padding: 10px 10px;
               display: grid;
               justify-content: center;
               margin: 20px;
         }
         .userpost{
               border: 1px black solid;
               display: flex;
               justify-content: center;
               text-align: center;
               padding: 5px 0;
               margin: 20px;
               padding: 10px;
               width: 510px;
               height: 550px;
         }
         .userpost span{
            font-weight: bold;
            font-size: 30px;
         }
         .userpost p{
            font-weight: bold;
            font-size: 20px;
            color: grey;
         }

         .userpost img{
               width: 400px;
               height: 400px;
               object-fit: contain;
               padding: 10px;
               
         }
         .like{
               position: relative;
               left:-200px;
               font-weight: bold;
            font-size: 30px;
         }
         .commment{
               position: relative;
               right:-200px;
               font-weight: bold;
            font-size: 30px;
         }
      </style>
      <div class="PostWrapper">
         <?php
               $servername = "db";
               $username = "root";
               $password = "root";
               $dbname = "feeds";
               
               // Create connection
               $conn = new mysqli($servername, $username, $password, $dbname);
               // Check connection
               if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
               }
               
               $sql_posts = "SELECT * FROM `{$_SESSION['username']}` ORDER BY add_date DESC";
               
               $result = $conn->query($sql_posts);

               if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {

                     echo '<div class="post">
                              <div class="userpost">
                              <div class="post_title"><span>'.$row["Title"].'</span><p>Posted By: '.$row['Poster'].'</p>
                              <div class="post_img"><img class="image" src="/Posts/'.$row['Poster'].'/'.$row['Contents'].'" alt="'.$row["Title"].'"></div>
                              <button class="like"><i class="fa-regular fa-heart"></i></button><button class="commment"><i class="fa-regular fa-comment"></i></button></div>
                              </div>
                           </div>';
                  }
               }else{
                  echo '<h1 style="text-align:center; font-weight:bold; font-size:30px;">Your Feed is Empty</h1>';
               } 

               $conn->close();
         ?>
      </div>
   </body>
</html>