<?php 
   session_start();
   if(isset($_SESSION['unique_id']))
   {
        header("location:users.php");
   }
   $otp = rand(0000,9999);
   $_SESSION['otp'] = $otp;
                         
  
?>

<?php include_once "header.php"; ?>
<body>
    <script>
function errorpassword(event){
    
    document.getElementById("error-txt").innerHTML= document.getElementById("btn").value;
    document.getElementsByClassName("error-txt").style.display="block";
}
        </script>
    <div class="wrapper">
        <section class="form signup">
            <header>PRO CHATTING</header>
            <form action="php/signup.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="error-txt"></div>
                  <div class="name-details">  
                    <div class="field input">
                        <label>FIRST NAME</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                     </div>
                        <div class="field input">
                        <label>LAST NAME</label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                       </div>
                    </div>
                    <div class="field input">
                        <label>E-Mail</label>
                        <input type="text" name="email" placeholder="E-Mail" required>
                    </div>
                        <div class="field input">
                        <label>PASSWORD</label>
                        <input type="password" onkeydown="errorpassword()" id="btn" name="password" placeholder="Password" required>
                        <i class="fas fa-eye"></i>
                       </div>
                    <div class="field image">
                        <label>select image</label>
                        <input type="file" name="file" required>
                    </div>
                    <div class="field button">
                        <input type="submit" value="continue to chat">
                    </div>
                 
                
            </form>
            <div class="link">Already signed up? <a href="login.php">Login Now</a></div>
        </section>
    </div>
    <script src="pass-show.js"></script>
    <script src="signup.js">
        
    </script>
</body>
</html> 