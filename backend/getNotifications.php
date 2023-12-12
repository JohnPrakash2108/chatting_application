<?php
include "connection.php";
session_start();
$outgoing_id = $_SESSION['unique_id'];
$seen = mysqli_query($conn, "SELECT * FROM `messages` WHERE `incoming_id` = '$outgoing_id' AND `seen`= 0 ");

$unseen_row = mysqli_fetch_assoc($seen);
$count = mysqli_num_rows($seen);

echo $count;