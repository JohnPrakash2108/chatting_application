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
                        <label>Check Your Email After Enter Email</label>
                        <input type="text" name="email" placeholder="Enter Your E-Mail" required>
                    </div>
                       
                   
                    <div class="field button">
                        <input type="submit" class="submit" value="Start Chat" name="submit">
                    </div>
              
                
            </form>
            
        </section>
    </div>
    
</body>
</html>
<?php
 session_start();
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

if(!isset($_SESSION['unique_id']))
{



 
 if(isset($_POST['submit']))
 {

  
 
  //Form Data
  include_once "config.php";
  
        $rec = $_POST['email'];
        




        require 'phpmailer/src/Exception.php';
        require 'phpmailer/src/PHPMailer.php';
        require 'phpmailer/src/SMTP.php';
      
        $mail = new PHPMailer(true);
      
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'chattingapp001@gmail.com';
        $mail->Password = 'ydccetoauhnbktel';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
      
        $mail->IsHTML(true);
        ////////
        $reciver = $rec;
        $_SESSION['email']=$reciver;
       ////////
       $sql = mysqli_query($conn,"SELECT `fname`,`lname` FROM `users` WHERE `email` = '$reciver' " );
      while( $row= mysqli_fetch_assoc($sql))
      {
       $fullname = $row['fname'].' '.$row['lname'];
      }
       ////////
        $mail->setFrom('chattingapp001@gmail.com');
        $mail->addAddress($reciver);
        $mail->Subject = 'From Chat Application';
        $otp = rand(0000,9999);
        $_SESSION['forgototp']=$otp;
        $sql5=mysqli_query($conn,"UPDATE `users` SET `otp`='$otp' WHERE `email`='$reciver'");
        $mail->Body = '
        <html>
          <body>
            <p>Hello, <b>'.$fullname.'</b></p><br>
            <p>Forgot Password (OTP) : <b>'.$otp.'</b></p>
          </body>
        </html>
        ';
        
        $_SESSION['gmail']=$reciver;
        
        $mail->send();
       header("location:forgotpass.php");

            
            
        }
    
     }
    
    else
    {
        header("location:users.php");
    }
  
?>

<!-- <script src="emailverify.js"></script> -->


