<?php
echo "hello";
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "../backend/connection.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_SESSION['friend_id']);
    $mess = mysqli_real_escape_string($conn, $_POST['message']);
    $encMsg = trim($mess);
    $chiper = "aes-256-cbc-hmac-sha256";
    $iv = 1234567891234567;
    $key = "This is a key";
    $options = 0;
    $mess = openssl_encrypt($encMsg, $chiper, $key, $options, $iv);
    $message = trim($mess);
    $refresh = "";
 

    if (!empty($encMsg)) {
        date_default_timezone_set('Asia/Kolkata');
        $date =      date('h:iA', $last_access);


        $sql = mysqli_query($conn, "INSERT INTO `incochat` VALUES (NULL, '$incoming_id', '$outgoing_id', '$message','$date', 0);");
    }
} else {
    header("../login.php");
}