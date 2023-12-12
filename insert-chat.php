<?php
   session_start();
   if(isset($_SESSION['unique_id']))
   {
      include_once "config.php";
      $outgoing_id=mysqli_real_escape_string($conn, $_POST['outgoing_id']);
      $incoming_id=mysqli_real_escape_string($conn, $_POST['incoming_id']);
      $message=mysqli_real_escape_string($conn, $_POST['message']);
      
      if(isset($_FILES['file']))
      {
         $img_name=$_FILES['file']['name'];
                
         $tmp_name=$_FILES['file']['tmp_name'];
         $img_explode=explode('.',$img_name);
         $img_ext=end($img_explode);
         $new_img_name="9502419692944015196996668303759182019899H". $img_name;
         if(!empty($img_name))
         {
         if(move_uploaded_file($tmp_name,"imges/".$new_img_name))
         {
            
            $message=$new_img_name;
         }
         }
         
      }
      
      if(!empty($message))
      {
         date_default_timezone_set('Asia/Kolkata');
         $date =      date('h:iA',$last_access);
        

        $sql=mysqli_query($conn, "INSERT INTO `messages` VALUES(NULL, '$incoming_id', '$outgoing_id', '$message','$date');");
      }
   
   }
   else{
       header("../login.php");
   }
?>