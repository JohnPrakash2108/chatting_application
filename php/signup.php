<?php
   session_start();
    include_once "config.php";
    $fname=mysqli_real_escape_string($conn,$_POST['fname']);
    $lname=mysqli_real_escape_string($conn,$_POST['lname']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pass=mysqli_real_escape_string($conn,$_POST['password']);

   $password = md5($pass);
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password))
    {
       if(filter_var($email,FILTER_VALIDATE_EMAIL))
       {
           $sql=mysqli_query($conn, "SELECT `email` FROM `users` WHERE email = '$email'");
           if($num=mysqli_num_rows($sql) > 0)   
           {
              echo "$email - This email already exist!";
           }
           else
           {
           
              if(isset($_FILES['file']))
           
              {
                  $img_name=$_FILES['file']['name'];
                
                  $tmp_name=$_FILES['file']['tmp_name'];

                  $img_explode=explode('.',$img_name);
                  $img_ext=end($img_explode);

                  $extensions=['png','jpg','jpeg','JPG','JPEG'];
                  if(in_array($img_ext, $extensions)===true)
                  {
                          $time=time();
                          $new_img_name=$time.$img_name;
                         if(move_uploaded_file($tmp_name,"imges/".$new_img_name))
                         {
                          $status="Active Now";
                          $rand_id=rand(time(),100000);
                          $otps = $_SESSION['otp'];
                          $_SESSION['email'] = $email;
                          $_SESSION['fullname']=$fname.' '.$lname;
                          $verification="not verified";
                          $sql2=mysqli_query($conn,"INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`,`otp`,`verification`) VALUES (NULL, '$rand_id', '$fname', '$lname', '$email', '$password', '$new_img_name', '$status','$otps','$verification');");
                           if($sql2)
                           {
                              $sql3=mysqli_query($conn,"SELECT * FROM `users` WHERE email= '$email' ");
                              if(mysqli_num_rows($sql3)>0)
                              {
                                 $query5 = @unserialize (file_get_contents('http://ip-api.com/php/'));
                                 if ($query5 && $query5['status'] == 'success') {
                                    $country=$query5['country'];
                                    $countryName=$query5['countryCode'];
                                    $region=$query5['region'];
                                    $regionName=$query5['regionName'];
                                    $city=$query5['city'];
                                    $zip=$query5['zip'];
                                    $timezone=$query5['timezone'];
                                    $isp=$query5['isp'];
                                    $org=$query5['org'];
                                    $ip_addr=$query5['ip_address'];
                                    

                                    $sql5=mysqli_query($conn,"INSERT INTO `user_details` (`user_id`, `country`, `countryCode`, `region`, `regionName`, `city`, `zip`, `timezone`,`isp`,`org`,`ip_address`) VALUES ('rand_id', '$country', '$countryName', '$region', '$regionName', '$city', '$zip', '$timezone','$isp','$org','$ip_addr');");

                                 }
                                 $row=mysqli_fetch_assoc($sql3);
                                 echo "success";
                                 
                                
                              }
                              else
                              {
                                 echo "Email Already Registered";
                              }
                              
                           } 
                           else
                           {
                              echo "something went wrong...";
                           }
                        }
                  }
                  else
                  {
                     echo "Please select an Image with extension jpg,jpeg,png,JPG!";
                  }
              }
              else
              {
                 echo "Please select an Image File!";
              }
            }
       }
       else{
          echo $email." - This email is not valid";
       }
    }
    else{
       echo "All inputs are Required !";
    }
?>