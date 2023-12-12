<?php
session_start();
$status = "";
if (isset($_SESSION['unique_id'])) {

    include_once "../backend/connection.php";
    // include_once "../header.php";

    $outgoing_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_SESSION['friend_id']);

    $output = "";
    $sql = "SELECT * FROM `incochat` 
                   LEFT JOIN `users` ON `users`.`unique_id`=`incochat`.`incoming_id`
                  WHERE (`outgoing_id` = '$outgoing_id' AND `incoming_id` = '$incoming_id')
                              OR (`outgoing_id` = '$incoming_id' AND `incoming_id`= '$outgoing_id') ORDER BY `mess_id`";
    $query = mysqli_query($conn, $sql);
    // $sql2 = "SELECT `profile_img`,`status` FROM `users` WHERE `unique_id` = '$incoming_id';";


    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_assoc($query)) {

            $encMsg = $row['msg'];
            $chiper = "aes-256-cbc-hmac-sha256";
            $iv = 1234567891234567;
            $key = "This is a key";
            $options = 0;
            $mess = openssl_decrypt($encMsg, $chiper, $key, $options, $iv);
            $msg = $row['msg'];



            $seenMsg = ($row['seen'] == 1) ? $seenMsg = "seen" : $seenMsg = "sent";
            if ($row['outgoing_id'] === $outgoing_id) //he is sender
            {

                $output .= '
               

            <div class="msg right-msg">
             

                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name"></div>
                        <div class="msg-info-time">' . $row['time'] . '</div>
                    </div>

                    <div class="msg-text">
                        ' . $mess . '
                    </div>
                </div>
            </div>

                ';
            } else {
                // he is receiver


                $output .= '
                <div class="msg left-msg">
               

                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name"></div>
                        <div class="msg-info-time">' . $row['time'] . '</div>
                    </div>

                    <div class="msg-text">
                        ' . $mess . '
                    </div>
                </div>
            </div>

                ';
            }
        }
    }
    echo $output;
} else {
    header("../login.php");
}



// <div class="no-lap" >
//                     <div class="sent msg" >
                    
//                         <span class="content" id=' . $row['mess_id'] . ' onmousedown= "deleteMsg(this)">' . $mess . '</span>

//                         <span class="time">' . $row['time'] . ' ' . $seenMsg . '
//                         </span>
//                     </div>


// <div class="no-lap" id=' . $row['mess_id'] . ' >
//                     <div class="received msg">
//                         <span class="content">' . $mess . '</span>
//                         <span class="time">' . $row['time'] . '
//                         </span>
//                     </div>
//                 </div>