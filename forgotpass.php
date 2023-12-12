<?php include_once "header.php"; ?>
<?php include_once "config.php"; ?>
<html>
<body>
   
    <div class="wrapper">
        <section class="form login">
            <header>Verify Otp</header>
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" autocomplete="off">
                <div class="error-txt">hello</div>
                  
                   
                    <div class="field input">
                        <label>Verify Otp</label>
                        <input type="text" name="otp" placeholder="Enter otp">
                    </div>
                       
                   
                    <div class="field button">
                        <input type="submit" class="submit" value="Verify Now" name="submit">
                    </div>
              
                
            </form>
            
        </section>
    </div>
    
</body>
</html>
<?php
 session_start();
 

if(!isset($_SESSION['unique_id']))
{



 
 

  
  include_once "config.php";
  if(isset($_POST['submit']))
     {
        $rec = $_POST['otp'];
        if($rec ==  $_SESSION['forgototp'])
        {
            $reciver=$_SESSION['gmail'];
            $sql = mysqli_query($conn,"UPDATE `users` SET `otp`=0 WHERE `email` = '$reciver'");
            
            if($sql)
            {
                
                
                    unset($_SESSION['otp']);
                    
                     header("location:changepass.php");
                
            }
            
        }
        else{
            echo "Otp is Wrong";
        }
     }
    }
    else
    {
        header("location:users.php");
    }
  
?>

<!-- <script src="emailverify.js"></script> -->


