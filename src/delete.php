<?php
   include('security.php');
   require "database/dbconfig.php";
   
   //deletes account
    if(isset($_POST['deleteAcc_btn'])){

        $query = "DELETE FROM `accounts` WHERE id = '".$_SESSION['acc_id']."'";
        $result = mysqli_query($connect, $query);

        $query2 = "DELETE FROM `bio` WHERE user = '".$_SESSION['username']."'";
        $result2 = mysqli_query($connect, $query2);

    if($result){
        $_SESSION['success'] = "Account Deleted ";
        header('location:login.php');
    }
}
?>
