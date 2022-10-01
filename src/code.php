<?php
   include('security.php');
   require "database/dbconfig.php";

   //login
   if(isset($_POST['login_btn']))
   {
       $username_login = strtolower($_POST['username']);
       $pepper = 'pajhfakjdhflashdhf';
       $pwd = $_POST['password'];
       $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
       $pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);
   

       $query = "SELECT * FROM accounts WHERE username='$username_login' AND password = '$pwd_hashed' ";
       $query_run = mysqli_query($connect, $query);
       $usertype = mysqli_fetch_array($query_run);

       if($usertype['usertype'] == 'admin')
       { 
           $_SESSION['username'] = $username_login;
           header('Location:index.php');
       }
       else if($usertype['usertype'] == 'user')
       {
            $dir = 'profiles/'.$_POST['username'];
            $_SESSION['user_dir'] = $dir;

            $pfp = 'profiles/'.$_POST['username'].'/pfp';
            $_SESSION['pfp'] = $pfp;


            $_SESSION['username'] = $username_login;
            $_SESSION['acc_id'] = $usertype['id'];
            $_SESSION['firstname'] = $usertype['firstname'];
            $_SESSION['lastname'] = $usertype['lastname'];
            header('Location:index.php');
       }
       else
       {
           $_SESSION['status'] = "Invalid User Details";
           header('Location:login.php');
       }
   }


   //Create New Account
   if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $usertype = 'user';
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $pepper = 'pajhfakjdhflashdhf';
    $pwd = $_POST['password'];
    $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
    $pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);


    $sql_u = "SELECT * FROM accounts WHERE username='$username'";
    $sql_e = "SELECT * FROM accounts WHERE email='$email'";
    $res_u = mysqli_query($connect, $sql_u);
    $res_e = mysqli_query($connect, $sql_e);

    $illegalSymbols= '/[\'^£$%&*()}{@#~?><>,|=+¬-]/';

    if (preg_match($illegalSymbols, $username) || preg_match($illegalSymbols, $firstname) || preg_match($illegalSymbols, $lastname))
    {
        $_SESSION['status'] = "Special Charaters are not allows";
    }else if (mysqli_num_rows($res_u) > 0) {
  	    $_SESSION['status'] = "Account Created Failed, Username Already Taken"; 
        header('location:register.php');	
  	}else if(mysqli_num_rows($res_e) > 0){
          $_SESSION['status'] = "Account Created Failed, Email Already Taken, Please Sign-In"; 
          header('location:register.php');
    }else{
        $query = "INSERT INTO accounts(username, firstname, lastname, email, password, usertype) VALUES('$username', '$firstname', '$lastname', '$email', '$pwd_hashed', '$usertype')";
        $result = mysqli_query($connect, $query);

        $query_bio = "INSERT INTO bio(user) VALUES ('$username')";
        $result_bio = mysqli_query($connect, $query_bio);


        $dir = 'profiles/'.$_POST['username'];
        $_SESSION['user_dir'] = $dir;
        mkdir($dir);
        chmod($dir, 0777);
        if($result){
            $_SESSION['success'] = "Account Created ";
            header('location:login.php');
        }else{
            $_SESSION['status'] = "Account Created Failed ";
            header('location:register.php');
        }
    }
}


?>
