<?php
   include('security.php');
   require "database/dbconfig.php";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title><?php $uri = $_SERVER['REQUEST_URI'];
        $url_components = parse_url($uri);
        parse_str($url_components['query'], $params);
        echo $params['username']?></title>
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
   <style>
        /* CSS design by @jofpin */
    @import url(https://fonts.googleapis.com/css?family=Raleway|Varela+Round|Coda);
    @import url(http://weloveiconfonts.com/api/?family=entypo);

    [class*="entypo-"]:before {
        font-family: 'entypo', sans-serif;
    }

    .title-pen {
        color: #333;
        font-family: "Coda", sans-serif;
        text-align: center;
    }
    .title-pen span {
        color: #55acee;
    }

    .user-profile {
        margin: auto;
        width: 25em; 
        height: 11em;
        background: #fff;
        border-radius: .3em;
    }

    .user-profile  .username {
        margin: auto;
        margin-top: -4.40em;
        margin-left: 5.80em;
        color: #658585;
        font-size: 1.53em;
        font-family: "Coda", sans-serif;
        font-weight: bold;
    }
    .user-profile  .name {
        margin: auto;
        display: inline-block;
        margin-left: 10.43em;
        color: #e76043; 
        font-size: .87em;
        font-family: "varela round", sans-serif;
    }
    .user-profile > .description {
        margin: auto;
        margin-top: 1.35em;
        margin-right: 4.43em;
        width: 14em;
        color: #c0c5c5; 
        font-size: .87em;
        font-family: "varela round", sans-serif;
    }
    .user-profile > img.avatar {
        padding: .7em;
        margin-left: .3em;
        margin-top: .3em;
        height: 6.23em;
        width: 6.23em;
        border-radius: 18em;
    }
    .user-profile li {
        margin: 0 auto;
        padding: 1.30em; 
        width: 33.33334%;
        display: table-cell;
        text-align: center;
    }

    .user-profile span {
        font-family: "varela round", sans-serif;
        color: #e3eeee;
        white-space: nowrap;
        font-size: 1.27em;
        font-weight: bold;
    }
    .user-profile span:hover {
        color: #daebea;
    }


    </style>

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
    
    $sql_posts = "SELECT `Friends` FROM `{$_SESSION['username']}` WHERE Friends = '".$params['username']."'";
    $result = $conn->query($sql_posts);
    $fetch_sql = mysqli_fetch_row($result);

    if (!$fetch_sql) {
        echo '<div class="alert alert-danger" role="alert" style="text-align:center; width: 40%; margin:auto; font-weight: bold;">
                Unable to load user: You have not added them
            </div>';
            $conn->close();
        die;
    }

    $conn->close();
    
    
    ?>
    
    <?php
        $uri = $_SERVER['REQUEST_URI'];
        $url_components = parse_url($uri);
        parse_str($url_components['query'], $params);

        $query = "SELECT profilepic FROM `accounts` WHERE username = '".$params['username']."'";
        $query_run = mysqli_query($connect, $query);
        $userprofilepic = mysqli_fetch_assoc($query_run);

        $query_bio = "SELECT bio FROM `bio` WHERE user = '".$params['username']."'";
        $query_run_bio = mysqli_query($connect, $query_bio);
        $userbio = mysqli_fetch_assoc($query_run_bio);

        $queryf = "SELECT `firstname`, `lastname` FROM `accounts` WHERE username = '".$params['username']."'";
        $query_run_f = mysqli_query($connect, $queryf);
        $queryl = "SELECT lastname FROM `accounts` WHERE username = '".$params['username']."'";
        $query_run_l = mysqli_query($connect, $queryl);
        $fname = mysqli_fetch_assoc($query_run_f);
        $lname = mysqli_fetch_assoc($query_run_l);
        
        $username= htmlspecialchars($params['username'], ENT_QUOTES, 'UTF-8');
        $bio = htmlspecialchars($userbio['bio'], ENT_QUOTES, 'UTF-8');
        $firstnameSanatised = htmlspecialchars($fname['firstname'], ENT_QUOTES, 'UTF-8');
        $lastnameSanatised = htmlspecialchars($lname['lastname'], ENT_QUOTES, 'UTF-8');

        if (!$userprofilepic){
            echo "<h1 style='text-align:center'>User Not Found</h1>";
            die;
        }else{
            echo '<h1 class="title-pen">'.$firstnameSanatised."<span> ".$lastnameSanatised.'</span></h1>
            <div class="user-profile">
            <img class="avatar" src="./ProfilePics/'.$userprofilepic['profilepic'].'" alt="Profile Pic" />
            <div class="username">@'.$username.'</div>
            
            <div class="name"><br></div>
            
            <div class="description"> '.$bio.' </div>
            </div>';
        }    

        
    ?>

<!-- Checks if user has added currently displayed user -->

    <hr style="width:80%;height:2px;border-width:0;color:gray;background-color:gray">
    <style>
        .PostWrapper{
            padding: 10px 10px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(550px, 550px));
            grid-template-rows: repeat(3, minmax(550px, 550px));
            justify-content: center;
            margin: 20px;
        }
        .userpost{
            border: 1px black solid;
            display: flex;
            justify-content: center;
            text-align: center;
            padding: 5px 0;
            font-weight: bold;
            margin: 20px;
            padding: 10px;
            width: 510px;
            height: 510px;
            position: relative;
        }

        .userpost img{
            width: 400px;
            height: 400px;
            object-fit: contain;
            padding: 10px;
        }
        .like{
            position: absolute;
            left:10px;
            bottom:10px;
        }
        .commment{
            position: absolute;
            right: 10px;
            bottom:10px;
        }
        .PostTitle{
            font-weight: bold;
            font-size: 100%;
        }
    </style>
    
        <?php
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
            
            $sql_posts = "SELECT * FROM `{$params['username']}`";
            
            $result = $conn->query($sql_posts);

            if ($result->num_rows > 0) {
                echo "<div class='PostWrapper'>";
                while($row = $result->fetch_assoc()) {

                    echo '<div class="post">
                            <div class="userpost">
                            <div class="post_title"><span class="PostTitle">'.$row["Title"].'</span>
                            <div class="post_img"><img class="image" src="/Posts/'.$params['username'].'/'.$row['Contents'].'" alt="'.$row["Title"].'"></div>
                            <button class="like"><i class="fa-regular fa-heart"></i></button><button class="commment"><i class="fa-regular fa-comment"></i></button></div>
                            </div>
                        </div>';
                }
            } else{
                echo '<div class="alert alert-warning" style="text-align:center; width: 40%; margin:auto; font-weight: bold;" role="alert">
                        User has not made a post yet';
            }

            $conn->close();
        ?>
    </div>
      
      
</body>