<?php
session_start();
include_once "../backend/connection.php";
// echo "ok";
$incoming = mysqli_real_escape_string($conn, $_SESSION['friend_id']);
$outgoing = mysqli_real_escape_string($conn, $_SESSION['unique_id']);

$sql = mysqli_query($conn, "DELETE FROM `incochat` WHERE `outgoing_id` = '$outgoing' AND `incoming_id` = '$incoming'");