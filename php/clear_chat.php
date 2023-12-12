<?php
   include_once "../header.php";
   include_once "config.php";
  $mess_id= mysqli_real_escape_string($conn, $_GET['mess_id']);
   $sql = mysqli_query($conn,"DELETE FROM `messages` WHERE `mess_id`='$mess_id' ");
   
?>