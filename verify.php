<?php include_once "header.php"; ?>
<?php include_once "backend/connection.php"; ?>
<html>

<body>

    <div class="wrapper">
        <section class="form login">
            <header>Verify Otp</header>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                <div class="error-txt">hello</div>


                <div class="field input">
                    <label>Verify Otp</label>
                    <input type="text" name="otp" placeholder="Enter otp">
                </div>


                <div class="field button">
                    <input type="submit" class="submit" value="Start Chat" name="submit">
                </div>


            </form>
            <div class="link">Not yet Received <a href="sinuppage.php">Resend Now</a></div>
        </section>
    </div>

</body>

</html>
<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['unique_id'])) {






    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'chattingapp001@gmail.com';
    $mail->Password = 'wasglpzwdmmsnbwj';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->IsHTML(true);
    ////////
    $reciver = $_SESSION['email'];
    ////////
    $sql = mysqli_query($conn, "SELECT `first_name`,`last_name` FROM `users` WHERE `email` = '$reciver' ");
    while ($row = mysqli_fetch_assoc($sql)) {
        $fullname = $row['first_name'] . ' ' . $row['last_name'];
    }
    ////////
    $mail->setFrom('chattingapp001@gmail.com');
    $mail->addAddress($reciver);
    $mail->Subject = 'From Chat Application';
    $mail->Body = '
  <html>
    <body>
      <p>Hello, <b>' . $fullname . '</b></p><br>
      <p></p>
      <p>Verify Your E-Mail (OTP) : <b>' . $_SESSION['otp'] . '</b></p>
    </body>
  </html>
  ';

    $mail->send();

    //Form Data
    include_once "backend/connection.php";
    if (isset($_POST['submit'])) {
        $rec = $_POST['otp'];
        if ($rec == $_SESSION['otp']) {
            $sql = mysqli_query($conn, "UPDATE `users` SET `otp`=0 WHERE `email` = '$reciver'");
            $sql2 = mysqli_query($conn, "UPDATE `users` SET `verification`='verified' WHERE `email` = '$reciver'");
            if ($sql) {
                if ($sql2) {
                    unset($_SESSION['otp']);
                    echo "success";
                    $_SESSION['unique_id'] = $row['unique_id'];
                    header("location:home.php");
                }
            }
        } else {
            echo "<p style='color:red';position:absolute;top:25%;font-size:20px'>Otp is Wrong</p>";
        }
    }
} else {
    header("location:login_sign.php");
    echo "ok";
}

?>

<!-- <script src="emailverify.js"></script> -->