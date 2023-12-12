<?php
   session_start();
   
   include_once "config.php";

   if(isset($_SESSION['unique_id']))
   {
        header("location:users.php");
   }
   
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $keyPass = md5($password);
    if(!empty($email) && !empty($password))
    {
          $sql=mysqli_query($conn,"SELECT * FROM `users` WHERE `email`='$email' AND `password` = '$keyPass' ");
          $sql2=mysqli_query($conn,"SELECT * FROM `users` WHERE `email`='$email'");
          if(mysqli_num_rows($sql2)!=0)
          {
          if(mysqli_num_rows($sql)>0)
          {
            $row=mysqli_fetch_assoc($sql);
            $status="Active now";
            if($row['verification']=='verified'){
                $sql2=mysqli_query($conn,"UPDATE `users` SET `status`='$status' WHERE `unique_id` = '{$row['unique_id']}'");
                if($sql2)
                {
                  $_SESSION['unique_id']=$row['unique_id'];
                  echo "success";
                }
            }
            else{
              $_SESSION['email']=$email;
              echo "verify";
              
              
            }
          }
          else
          {
            echo "E-MAIL OR PASSWORD IS INCORRECT!";
          }
        }
        else
        {
          echo "No Email Found Please Sign Up First";
        }
    }
    else
    {
        echo "All fields are required!";
    }

?>