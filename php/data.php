<?php
      while($row=mysqli_fetch_assoc($sql)){
          $sql2="SELECT * FROM `messages` WHERE (`incoming_id`={$row['unique_id']}
                                 OR `outgoing_id`={$row['unique_id']}) AND (`outgoing_id`={$outgoing_id}
                                 OR `incoming_id`={$outgoing_id}) ORDER BY `mess_id` DESC LIMIT 1";
        $query2=mysqli_query($conn,$sql2);
        $_SESSION['status']=$row['status'];
        $row2=mysqli_fetch_assoc($query2);
        $you="";
        
        if(mysqli_num_rows($query2)>0)
        {
            $result=$row2['msg'];
            ($outgoing_id == $row2['outgoing_id']) ? $you="You: " : $you=" ";
        }
        else
        {
            $result="No messages are available";
            
        }
        
        (strlen($result)>28)? $msg=substr($result,0,28).'...' : $msg=$result;
        
       

        //check online or offline
        ($row['status'] == "offline now") ? $offline ="offline now" : $offline ="";
      
        $output .='
                    <a href="chat.php?user_id='.$row['unique_id'].'" id="availuser">
                    <div class="content">
                        <img src="php/imges/' .$row['img'].'" alt="">
                        <div class="details">
                            <span> '.$row['fname']." ".$row['lname'].'</span>
                            <p>'.$you . $msg.'</p>
                        </div>
                    </div>
                    <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                </a>   
        
        ';
    }
?>
