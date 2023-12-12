<?php



while ($row = mysqli_fetch_assoc($sql)) {










    $sql2 = "SELECT * FROM `messages` WHERE (`incoming_id`={$row['unique_id']}
                                 OR `outgoing_id`={$row['unique_id']}) AND (`outgoing_id`={$outgoing_id}
                                 OR `incoming_id`={$outgoing_id}) ORDER BY `mess_id` DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $_SESSION['status'] = $row['status'];
    $row2 = mysqli_fetch_assoc($query2);
    $you = "";

    if (mysqli_num_rows($query2) > 0) {
        $result = $row2['msg'];
        ($outgoing_id == $row2['outgoing_id']) ? $you = "You: " : $you = " ";
    } else {
        $result = "No messages are available";
    }

    (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;


    $incoming_id = $row['unique_id'];
    $seen = mysqli_query($conn, "SELECT * FROM `messages` WHERE `outgoing_id` = '$incoming_id' AND `incoming_id` ='$outgoing_id' AND `seen`= 0 ");

    $unseen_row = mysqli_fetch_assoc($seen);
    $count = mysqli_num_rows($seen);
    //check online or offline
    ($row['status'] == "offilne") ? $offline = "" : $offline = "offline";
    $chiper = "aes-256-cbc-hmac-sha256";
    $iv = 1234567891234567;
    $key = "This is a key";
    $options = 0;
    $mess = openssl_decrypt($msg, $chiper, $key, $options, $iv);
    $output .= '
                <a class="user" href="chat-fullpage.php?user_id=' . $row['unique_id'] . '" id="availuser">
                    <i class="fa fa-duotone fa-flag note-notify"></i>
                    <img src="backend/images/' . $row['profile_img'] . '" alt="profile" class=" user-profile">
                    <div class="info">
                        <div class="name"> ' . $row['first_name'] . " " . $row['last_name'] . '</div>
                        <div class="last-msg">' . $you . $mess . '<span class="time"></span> </div>
                    </div>
                    <span class="count">' . $count . '</span>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>  
                
                ';
    // <a href="home.php?user_id=' . $row['unique_id'] . '" id="availuser">
    // <div class="content">
    //     <img src="backend/images/' . $row['profile_img'] . '" alt="" >
    //     <div class="details">
    //         <span> ' . $row['first_name'] . " " . $row['last_name'] . '</span>
    //         <p>' . $you . $msg . '</p>
    //     </div>
    // </div>

}