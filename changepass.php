<?php include_once "header.php"; ?>
<?php include_once "config.php"; ?>
<html>
<body>
   
    <div class="wrapper">
        <section class="form login">
            <header>Change Password</header>
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" autocomplete="off">
                <div class="error-txt"></div>
                  
                   
                    <div class="field input">
                        <label>Change your password</label>
                        <input type="text" name="pass1" placeholder="Enter New Password">
                    </div>
                    <div class="field input">
                        
                        <input type="text" name="cnfpass1" placeholder="Enter Confirm Password">
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
    include_once "header.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
      if(isset($_POST['submit']))
      {
        $pass=$_POST['pass1'];
        $pass2=$_POST['cnfpass1'];
        if($pass==$pass2)
        {
            $emailmess = $_SESSION['gmail'];
            $password = md5($pass);
            $sql6 = mysqli_query($conn,"UPDATE `users` SET `password` ='$password' WHERE `email` ='$emailmess'");
            unset($_SESSION['gmail']);
            $query7 = mysqli_query($conn,"SELECT `unique_id` FROM `users` WHERE `email`='$emailmess'");
            $row=mysqli_fetch_row($query7);
            $_SESSION['unique_id']=$row['unique_id'];
                        /////////////////////
                         
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
                        $reciver = $_SESSION['email'];
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
                        $mail->Body = '
                        <html>
                            <body>
                            <p>Hello, <b>'.$fullname.'</b></p><br>
                            <p>Your Password Is Successfully Updated : <b>'.$pass.'</b></p>
                            </body>
                        </html>
                        ';

                        $mail->send();
                    ////////////////////


            header("location:users.php");
        }
        else
        {
            echo "Passwords dosen't match";
        }
      }

?>