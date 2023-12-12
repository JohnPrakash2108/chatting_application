<?php
// include_once "../header.php";
include_once "connection.php";
    session_start();
    $outgoing=mysqli_real_escape_string($conn, $_GET['outgoing']);
    $incoming=mysqli_real_escape_string($conn, $_GET['incoming']);
    $sql5 = mysqli_query($conn,"DELETE FROM `messages` WHERE `incoming_id`='$incoming' AND `outgoing_id`='$outgoing'" );
?>  
