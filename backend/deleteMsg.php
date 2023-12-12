<?php
include_once "connection.php";

$mess_id = mysqli_real_escape_string($conn, $_GET['mess_id']);
$sql = mysqli_query($conn, "DELETE FROM `messages` WHERE `mess_id`= '$mess_id'");