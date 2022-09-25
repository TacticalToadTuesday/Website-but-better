<?php
   include('security.php');
   require "database/dbconfig.php";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Add Friends</title>
      <link rel="stylesheet" href="style.css">
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
                                 <li class="active"><a href="profile.php">Profile</a></li>
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
    </div>
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
        $query = "SELECT profilepic FROM `accounts` WHERE username = '".$_SESSION['username']."'";
        $query_run = mysqli_query($connect, $query);
        $userprofilepic = mysqli_fetch_assoc($query_run);

        $query_bio = "SELECT bio FROM `bio` WHERE user = '".$_SESSION['username']."'";
        $query_run_bio = mysqli_query($connect, $query_bio);
        $userbio = mysqli_fetch_assoc($query_run_bio);

        $queryf = "SELECT firstname FROM `accounts` WHERE username = '".$_SESSION['username']."'";
        $query_run_f = mysqli_query($connect, $queryf);
        $queryl = "SELECT lastname FROM `accounts` WHERE username = '".$_SESSION['username']."'";
        $query_run_l = mysqli_query($connect, $queryl);
        $fname = mysqli_fetch_assoc($query_run_f);
        $lname = mysqli_fetch_assoc($query_run_l);


        
        $username= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
        $bio= htmlspecialchars($userbio['bio'], ENT_QUOTES, 'UTF-8');
        $firstnameSanatised = htmlspecialchars($fname['firstname'], ENT_QUOTES, 'UTF-8');
        $lastnameSanatised = htmlspecialchars($lname['lastname'], ENT_QUOTES, 'UTF-8');
        
        echo '<h1 class="title-pen">'.$firstnameSanatised."<span> ".$lastnameSanatised.'</span></h1>
        <div class="user-profile">
            <img class="avatar" src="./ProfilePics/'.$userprofilepic['profilepic'].'" alt="Profile Pic" />
            <div class="username">@'.$username.'</div>
          
            <div class="name"><br></div>

            <div class="description"> '.$bio.' </div>
        </div>';

        
    ?>

    <form action="logout.php" method= "POST">
        <button type="submit"  name="logout_btn"> Logout</button>
    </form>

    <form method="post" action="delete.php" >
        <button type="submit" name="deleteAcc_btn">Delete Account</button>
    </form>

    <hr style="width:80%;height:2px;border-width:0;color:gray;background-color:gray">
        
      
      
    </body>

<?php
error_reporting(0);


// If upload button is clicked ...
if (isset($_POST['upload'])) {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];


    $temp = explode(".", $_FILES["uploadfile"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

	$folder = "./ProfilePics/" . $newfilename;
    
    echo "<h1>$newfilename</h1>";

    $type=$_FILES["uploadfile"]["type"];     
    $extensions=array('image/jpeg', 'image/png', 'image/gif', 'image/jpg' );
    if( in_array( $type, $extensions )){
        //do something

         // Get all the submitted data from the form
        $query = "UPDATE accounts SET profilePic = '".$newfilename."' WHERE id = '".$_SESSION['acc_id']."'";
        $query_run = mysqli_query($connect, $query);
        // Execute query

        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3> Image uploaded successfully!</h3>";
        } else {
            echo "<h3> Failed to upload image!</h3>";
        }
    }else{
        echo "<h3>Please upload a valid image (Supported formats include; .jpg .png and .gif)</h3>";
    }

}

?>


<body>
	<div id="content">
		<form method="POST" action="" enctype="multipart/form-data">
			<div class="form-group">
				<input class="form-control" type="file" name="uploadfile" value="" />
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
			</div>
		</form>
	</div>


    <div class = "setBio">
        <form method="POST" action="" enctype="multipart/form-data">
            <label class="form-control-label">Bio</label>
            <input type="text" name="bio" class="form-control">
            <button type="submit" name="biosubmit" class="btn btn-outline-primary">Update Bio</button>
        </form>
    </div>
<?php 
if (isset($_POST['biosubmit'])) {
    echo "<h1>Updated Bio</h1>";
    $bio = $_POST['bio'];
    $query = "UPDATE `bio` SET `bio`= '".$bio."' WHERE user = '".$_SESSION['username']."'";
    $result = mysqli_query($connect, $query);
}
?>

</body>




</html>
