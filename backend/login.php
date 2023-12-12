<?php
session_start();
include_once "connection.php";

$email =  $_POST['login_email'];
$pass = $_POST['login_password'];
$password = md5($pass);
if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`='$email' AND `password` = '$password' ");
    $sql2 = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`='$email'");
    if (mysqli_num_rows($sql2) != 0) {
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $status = "Online";
            if ($row['verification'] == 'verified') {
                $sql2 = mysqli_query($conn, "UPDATE `users` SET `status`='$status' WHERE `unique_id` = '{$row['unique_id']}'");
                if ($sql2) {
                    $_SESSION['unique_id'] = $row['unique_id'];

                    echo "success";
                }
            } else {
                $_SESSION['email'] = $email;
                echo "verify";
            }
        } else {
            echo "E-MAIL OR PASSWORD IS INCORRECT!";
        }
    } else {
        echo "No Email Found Please Sign Up First";
    }
} else {
    echo "All fields are required!";
}