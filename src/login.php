<?php
   session_start();
   ?>
<!DOCTYPE html>
<html >
   <head>
        <title>Login Page</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
        <link rel="stylesheet" href="./main.css">

   </head>
   <body >
   <?php
         if(isset($_SESSION['success']) && $_SESSION['success'] !='')
         {
            echo '<h2 class="bg-primary text-white">'.$_SESSION['success'].'</h2>';
            unset($_SESSION['success']);
         }

         if(isset($_SESSION['status']) && $_SESSION['status'] !='')
         {
            echo '<h2 class="bg-danger text-white">'.$_SESSION['status'].'</h2>';
            unset($_SESSION['status']);
         }

         ?>
        <form action="code.php" method="post"  class="md-float-material form-material" >
        <!-- <div align="center">
            <h2 class="text-muted text-center p-b-5">Sign in with your regular account</h2>
            <br>
            Username: <input type="text" name="username" class="form-control" required=""><br><br>
            Password :<input type="password" name="password" class="form-control" required=""><br>
            <a href="register.php" class="text-right f-w-600"> New account</a><br>
            <button type="submit" name="login_btn" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
         </div>-->





    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    Login
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form>
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="text" name="username" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" name="password" class="form-control" required="">
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" name="login_btn" class="btn btn-outline-primary">LOGIN</button>

                                </div>
                            </div>

                            <div class="form-group">
                                <a href="register.php" class="text-right f-w-600"> <label class="form-control-label">Create an Account</label></a>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
        </form>




</body>
</html>
