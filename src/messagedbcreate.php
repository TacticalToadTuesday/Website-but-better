<?php
    include('security.php');
    require "database/dbconfig.php";
    require "database/makedatabases.php";
?>

<?php
    $uri = $_SERVER['REQUEST_URI'];
    $url_components = parse_url($uri);
    parse_str($url_components['query'], $params);
    // Messages {Username} Database
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

    // sql to create table

    //R - Reciever
    //S - Sender
    $sql = "CREATE TABLE IF NOT EXISTS `{$_SESSION['username']}-{$params['user']}` (
                `RorS` varchar(255) NOT NULL,
                `Message` text COLLATE utf8mb4_general_ci NOT NULL,
                `Date` date,
                `Time` time
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $sql_friend = "CREATE TABLE IF NOT EXISTS `{$params['user']}-{$_SESSION['username']}` (
        `RorS` varchar(255) NOT NULL,
        `Message` text COLLATE utf8mb4_general_ci NOT NULL,
        `Date` date NOT NULL,
        `Time` time
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    if(!$params['user']){
        return;
    }else{
    $conn->query($sql);
    $conn->query($sql_friend);   
    $conn->close();
    }
?>
