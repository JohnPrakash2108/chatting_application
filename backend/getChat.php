<?php
session_start();
$status = "";
if (isset($_SESSION['unique_id'])) {

    include_once "connection.php";
    include_once "../header.php";

    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

    $output = "";
    $sql = "SELECT * FROM `messages` 
                   LEFT JOIN `users` ON `users`.`unique_id`=`messages`.`incoming_id`
                  WHERE (`outgoing_id` = '$outgoing_id' AND `incoming_id` = '$incoming_id')
                              OR (`outgoing_id` = '$incoming_id' AND `incoming_id`= '$outgoing_id') ORDER BY `mess_id`";
    $query = mysqli_query($conn, $sql);
    $sql2 = "SELECT `profile_img`,`status` FROM `users` WHERE `unique_id` = '$incoming_id';";

    $query2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_assoc($query2)) {
        $image = $row2['profile_img'];
        $status = $row2['status'];
    }
    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_assoc($query)) {

            $encMsg = $row['msg'];
            $chiper = "aes-256-cbc-hmac-sha256";
            $iv = 1234567891234567;
            $key = "This is a key";
            $options = 0;
            $mess = openssl_decrypt($encMsg, $chiper, $key, $options, $iv);
            $msg = $row['msg'];

            $st1 = substr($msg, "40");  //40 J
            $st2 = str_replace("9502419692944015196996668303759182019899", "H", $msg);


            $st3 = "H" . $st1;

            $st4 = substr($msg, "40");
            $st5 = str_replace("9502419692944015196996668303757396100296", "J", $msg);

            $st6 = "J" . $st4;

            if ($st2 == $st3) {

                $mess = '<img src="backend/chatImages/' . $msg . '" alt="no img" width="200px" height="200px">';
            } else {
                $mess = $mess;
            }

            $seenMsg = ($row['seen'] == 1) ? $seenMsg = "seen" : $seenMsg = "sent";
            if ($row['outgoing_id'] === $outgoing_id) //he is sender
            {

                $output .= '
               
                 <div class="no-lap" >
                    <div class="sent msg" >
                    
                        <span class="content" id=' . $row['mess_id'] . ' onmousedown= "deleteMsg(this)">' . $mess . '</span>

                        <span class="time">' . $row['time'] . ' ' . $seenMsg . '
                        </span>
                    </div>
               

                ';
            } else {
                // he is receiver


                $output .= '
                <div class="no-lap" id=' . $row['mess_id'] . ' >
                    <div class="received msg">
                        <span class="content">' . $mess . '</span>
                        <span class="time">' . $row['time'] . '
                        </span>
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

//  <div class="chat incoming">
//                             <div class="details">
//                             <p>' . $mess . '<span style="font-size:10px;color:red;padding-top:20px;padding-bottom:0px;padding-left:10px">' . $row['time'] . '</span></p>
                                
//                             </div>
//                         </div>



                // <div class="chat outgoing">
                //     <div class="details">
                //     <p>' . $mess . '<span style="font-size:10px;color:red;padding-top:20px;padding-bottom:0px;padding-left:10px">' . $row['time'] . '</span></p>
                        
                //     </div>
                // </div>