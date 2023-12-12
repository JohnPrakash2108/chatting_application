
<?php include_once "header.php"; ?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link href="https://fonts.googleapis.com/css?family=Assistant:400,700" rel="stylesheet"><link rel="stylesheet" href="./style.css">
  <link href="loginstyle.css" rel="stylesheet"><link rel="stylesheet" href="./style.css">

</head>
<body>
<?php
   
   
   include_once "config.php";

   if(isset($_SESSION['unique_id']))
   {
        header("location:users.php");
   }
   ?>
<!-- partial:index.partial.html -->
<section class='login' id='login'>
  <div class='head'>
  <h1 class='company'>LOGIN FOR YOUR CHAT</h1>
  
  </div>
  <p class='msg'></p>
 
  <section class="form login">
    <form action="php/login.php" method="post" autocomplete="off">
    <div class="error-txt"></div>
    <div class="field input">
  <input type="email" placeholder='E-Mail' class='text' id='username' name="email" required><br>
</div>
<div class="field input">
  <span style="color:black;"><input type="password" placeholder='********' name="password" class='password'>
</span>
  <i class="fas fa-eye"></i>
</div>
  <div class="field button">
  <input type="submit" class='btn-login' id='do-login' value="Start Chat">
</div>
<div class="button">
  <span id='forgot'><input type="button" class='btn-login' value="Forgot Password"></span>
  <a href="sinuppage.php"><input type="button" class='btn-login' value="SignUp Now"></a>
  
</div>                                                                                              
    </form>
  </div>
</section>

<!-- partial -->
<script src="pass-show.js"></script>
    <script src="php/loginuser.js"></script>
  <script  src="./script.js"></script>

</body>
</html>
