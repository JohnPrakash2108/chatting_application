<?php
include_once "../header.php";
include_once "config.php";
    
    $mess_id2=mysqli_real_escape_string($conn, $_GET['outgoing']);
    $mess_id3=mysqli_real_escape_string($conn, $_GET['incoming']);
    $sql2 = mysqli_query($conn,"DELETE FROM `messages` WHERE `outgoing_id`=$mess_id2 AND `incoming_id`=$mess_id3" );
?>  
