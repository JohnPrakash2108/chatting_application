<?php
   $conn=mysqli_connect("localhost","root","","chat");
   if(!$conn)
   {
       echo "connected ".mysqli_connect_error();
   }
  
?>