<?php
session_start();


include_once "connection.php";
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$about  = $_POST['about'];
$profession = $_POST['profession'];
$bio = $_POST['bio'];
$note = $_POST['note'];
if (!empty($_FILES['image']['name'])) {
    $unique_id = $_SESSION['unique_id'];
    $img_name = $_FILES['image']['name'];

    $tmp_name = $_FILES['image']['tmp_name'];

    $img_explode = explode('.', $img_name);
    $img_ext = end($img_explode);

    $extensions = ['png', 'jpg', 'jpeg', 'JPG', 'JPEG'];
    if (in_array($img_ext, $extensions) === true) {
        $time = time();
        $new_img_name = $time . $img_name;
        if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
            $query = mysqli_query($conn, "UPDATE `users` SET `first_name` = '$fname',`last_name`='$lname',`about` = '$about',`profile_img` = '$new_img_name' WHERE `unique_id` = '$unique_id' ");
            if ($query) {
                echo "success";
            } else {
                echo "fail";
            }
        }
    }
} else {
    $unique_id = $_SESSION['unique_id'];
    $query = mysqli_query($conn, "UPDATE `users` SET `first_name` = '$fname',`last_name`='$lname',`about` = '$about',`profession`='$profession',`bio`='$bio',`note`='$note' WHERE `unique_id` = '$unique_id' ");
    if ($query) {
        echo "success";
    } else {
        echo "fail";
    }
}