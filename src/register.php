<?php
   session_start();
   ?>
<html>
   <head>
      <title>new  account</title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'><link rel="stylesheet" href="./main.css">
   </head>
   <body>
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
      <form id="main" method="post" action="code.php" >
         <!-- <div align="center">
            Username: <input type="text" class="form-control" name="username" id="name"  required><br><br>
            Email :<input type="email" class="form-control" id="email" name="email" ><br><br>
            Password :<input type="password" class="form-control" id="password" name="password" ><br><br>

            <br><br>
            <button type="submit" name="register" class="btn btn-primary m-b-0">Submit</button><br>
            <a href="login.php" class="text-right f-w-600"> Alredy Have account Login</a><br>
         </div> -->

         <div class="container">
             <div class="row">
                 <div class="col-lg-3 col-md-2"></div>
                 <div class="col-lg-6 col-md-8 login-box">
                     <div class="col-lg-12 login-key">
                         <i class="fa fa-user-plus" aria-hidden="true"></i>
                     </div>
                     <div class="col-lg-12 login-title">
                         Register
                     </div>

                     <div class="col-lg-12 login-form">
                         <div class="col-lg-12 login-form">
                             <form>
                                 <div class="form-group">
                                     <label class="form-control-label">USERNAME</label>
                                     <input type="text" name="username" id="name" class="form-control" required="">
                                 </div>

                                 <div class="form-group">
                                     <label class="form-control-label">FIRSTNAME</label>
                                     <input type="text" name="firstname" id="name" class="form-control" required="">
                                 </div>

                                 <div class="form-group">
                                     <label class="form-control-label">LASTNAME</label>
                                     <input type="text" name="lastname" id="name" class="form-control" required="">
                                 </div>

                                 <div class="form-group">
                                     <label class="form-control-label">EMAIL</label>
                                     <input type="email" id="email" name="email" class="form-control" required="">
                                 </div>

                                 <div class="form-group">
                                     <label class="form-control-label">PASSWORD</label>
                                     <input type="password" id="password" name="password" class="form-control" required="">
                                 </div>

                                 <div class="col-lg-12 loginbttm">
                                     <div class="col-lg-6 login-btm login-text">
                                         <!-- Error Message -->
                                     </div>
                                     <div class="col-lg-6 login-btm login-button">
                                         <button type="submit" name="register" class="btn btn-outline-primary">Register</button>

                                     </div>
                                 </div>

                                 <div class="form-group">
                                     <a href="login.php" class="text-right f-w-600"> <label class="form-control-label">Have an Account? Login</label></a>

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
