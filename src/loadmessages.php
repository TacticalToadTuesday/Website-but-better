<?php
   include('security.php');
   require "database/dbconfig.php";
   require "database/makedatabases.php";
   ?>

<?php
    $uri = $_SERVER['REQUEST_URI'];
    $url_components = parse_url($uri);
    parse_str($url_components['query'], $params);

    $sql = "SELECT * FROM `{$_SESSION['username']}-{$params['user']}`";

     $servername = "db";
     $username = "root";
     $password = "root";
     $dbname = "Messages";

     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     }

     $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["RorS"] == "sent"){
                $timepos = "time-right";
            }else{
                $timepos = "time-left";
            }

            echo '<div class="container '.$row["RorS"].'">
                    <p>'.$row["Message"].'</p>
                    <span class="'.$timepos.'">'.$row['Time'].'</span>
                </div>';
        }
    }else{
        echo '<div class="alert alert-warning" role="alert" style="text-align:center; width: 40%; margin:auto; font-weight: bold;">You have no messages yet. Send a message</div>';
    } 

    if(isset($_POST['typedmessage'])){
        $msgSQL = "INSERT INTO `{$_SESSION['username']}-{$params['user']}` (`RorS`, `Message`, `Date`, `Time`) VALUES
        ('sent', '{$_POST['typedmessage']}', now(), now());";

        $msgSQL_Friend = "INSERT INTO `{$params['user']}-{$_SESSION['username']}` (`RorS`, `Message`, `Date`, `Time`) VALUES
        ('received', '{$_POST['typedmessage']}', now(), now());";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->query($msgSQL);
        $conn->query($msgSQL_Friend);
    }



?>