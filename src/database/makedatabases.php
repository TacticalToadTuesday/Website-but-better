<!-- Relations {Username} Database-->
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
    $sql = "CREATE TABLE IF NOT EXISTS {$_SESSION['username']} (
       Friends varchar(255) PRIMARY KEY,
       add_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);";

    $conn->query($sql);   
    $conn->close();
?>

<!-- Posts {Username} Database-->
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

    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS {$_SESSION['username']} (
       PostID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
       Title varchar(255),
       Contents varchar(255),
       add_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);";

    $conn->query($sql);   
    $conn->close();
?>

<!-- Creates User Post Folder -->
<?php
    if(!file_exists("Posts/{$_SESSION['username']}")){
        mkdir("Posts/{$_SESSION['username']}", 0755, true);
    }
?>



<!-- Feed {Username} Database-->
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

    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS {$_SESSION['username']} (
       Poster varchar(255),
       Title varchar(255),
       Contents varchar(255),
       add_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);";

    $conn->query($sql);   
    $conn->close();
?>