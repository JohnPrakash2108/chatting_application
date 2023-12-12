<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "connection.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $meas = mysqli_real_escape_string($conn, $_POST['message']);
    $mess = $meas;
    $encMsg = trim($mess);
    $chiper = "aes-256-cbc-hmac-sha256";
    $iv = 1234567891234567;
    $key = "This is a key";
    $options = 0;
    $mess = openssl_encrypt($encMsg, $chiper, $key, $options, $iv);
    $message = trim($mess);
    $refresh = "";
    if (isset($_FILES['file'])) {
        $img_name = $_FILES['file']['name'];

        $tmp_name = $_FILES['file']['tmp_name'];
        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);
        $new_img_name = "9502419692944015196996668303759182019899H" . $img_name;
        $extensions = ['mp4', 'mkv'];
        if (move_uploaded_file($tmp_name, "chatImages/" . $new_img_name)) {

            $message = $new_img_name;
        }
    }

    if (!empty($encMsg)) {
        date_default_timezone_set('Asia/Kolkata');
        $date = date('h:iA', $last_access);


        $sql = mysqli_query($conn, "INSERT INTO `messages` VALUES (NULL, '$incoming_id', '$outgoing_id', '$message','$date', 0);");
    }
} else {
    header("../login.php");
}