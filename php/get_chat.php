

</script>
<?php
    session_start();
   $status="";
   if(isset($_SESSION['unique_id']))
   {
    
      include_once "config.php";
      include_once "../header.php";
   
      $outgoing_id=mysqli_real_escape_string($conn, $_POST['outgoing_id']);
      $incoming_id=mysqli_real_escape_string($conn, $_POST['incoming_id']);
        
    $output="";
    $sql="SELECT * FROM `messages` 
                   LEFT JOIN `users` ON `users`.`unique_id`=`messages`.`incoming_id`
                  WHERE (`outgoing_id` = '$outgoing_id' AND `incoming_id` = '$incoming_id')
                              OR (`outgoing_id` = '$incoming_id' AND `incoming_id`= '$outgoing_id') ORDER BY `mess_id`";
    $query=mysqli_query($conn, $sql);
    $sql2 = "SELECT `img`,`status` FROM `users` WHERE `unique_id` = '$incoming_id';";
    
    $query2 = mysqli_query($conn, $sql2);
    while($row2=mysqli_fetch_assoc($query2)){
        $image=$row2['img'];
        $status=$row2['status'];
    }
    if(mysqli_num_rows($query)>0)
    {
       
        while($row=mysqli_fetch_assoc($query)){
            $msg_id = $row['mess_id'];
            $msg=$row['msg'];
            $mess=$row['msg'];
            $st1=substr($msg,"40");  //40 J
            $st2=str_replace("9502419692944015196996668303759182019899","H",$msg);

            
            $st3="H".$st1;

            $st4=substr($msg,"40");
            $st5=str_replace("9502419692944015196996668303757396100296","J",$msg);

            $st6="J".$st4;

            if($st2==$st3){
                
                $mess = '<img style="border-radius: 0%;" src="imges/'.$msg.'" alt="no img" width="200px" height="200px">';
            }
            
            
           
            else
            {
                $mess=$row['msg'];
                

            }

            
            if($row['outgoing_id'] === $outgoing_id)//he is sender
            {
                
                $output.='
                   
               
                <div class="chat outgoing">
                    <div class="details">
                    <p id="'.$msg_id.'" onmousedown="deletechat(this)">'.$mess.'<span style="font-size:10px;color:red;padding-top:20px;padding-bottom:0px;padding-left:10px">'.$row['time'].'</span></p>
                        
                    </div>
                </div>
              

                ';
            }
            else{      
                    // he is receiver

                    
                $output.='
              
                            <div class="chat incoming">
                            <img id="friendphoto" src="php/imges/'.$image.'" alt="no img">
                            <div class="details">
                            <p >'.$mess.'<span style="font-size:10px;color:red;padding-top:20px;padding-bottom:0px;padding-left:10px">'.$row['time'].'</span></p>
                                
                            </div>
                        </div>
                    
                
                ';
            }
        }
    }
    
    echo $output;
    

    }
   
   else{
       header("../login.php");
   }

  
  


?>
<script src="../userschat.js"></script>
   













