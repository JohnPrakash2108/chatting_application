<?php
include_once "connection.php";

session_start();

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$pass = mysqli_real_escape_string($conn, $_POST['password']);

$password = md5($pass);
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT `email` FROM `users` WHERE email = '$email'");
        if ($num = mysqli_num_rows($sql) > 0) {
            echo "$email - This email already exist!";
        } else {

            if (isset($_FILES['file'])) {
                $img_name = $_FILES['file']['name'];

                $tmp_name = $_FILES['file']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

                $extensions = ['png', 'jpg', 'jpeg', 'JPG', 'JPEG'];
                if (in_array($img_ext, $extensions) === true) {
                    $time = time();
                    $new_img_name = $time . $img_name;
                    if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                        $status = "Offline";
                        $rand_id = rand(time(), 100000);

                        $_SESSION['email'] = $email;
                        $_SESSION['fullname'] = $fname . ' ' . $lname;
                        $verification = "not verified";
                        $sql2 = mysqli_query($conn, "INSERT INTO `users` (`id`, `unique_id`, `first_name`, `last_name`, `email`, `password`, `profile_img`, `status`,`otp`,`verification`) VALUES (NULL, '$rand_id', '$fname', '$lname', '$email', '$password', '$new_img_name', '$status','$rand_id','$verification');");
                        if ($sql2) {
                            $sql3 = mysqli_query($conn, "SELECT * FROM `users` WHERE email= '$email' ");
                            if (mysqli_num_rows($sql3) > 0) {
                                $row = mysqli_fetch_assoc($sql3);
                                echo "success";
                            } else {
                                echo "Email Already Registered";
                            }
                        } else {
                            echo "something went wrong...";
                        }
                    }
                } else {
                    echo "Please select an Image with extension jpg,jpeg,png,JPG!";
                }
            } else {
                echo "Please select an Image File!";
            }
        }
    } else {
        echo $email . " - This email is not valid";
    }
} else {
    echo "All inputs are Required !";
}