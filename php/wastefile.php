<?php
// $query = @unserialize (file_get_contents('http://ip-api.com/php/'));
// if ($query && $query['status'] == 'success') {
// echo 'Hey user from ' . $query['country'] . ', ' . $query['city'] . '!';
// }
// foreach ($query as $data) {
//     echo $data . "<br>";
// }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
















include_once "config.php"; 
$sql=mysqli_query($conn,'SELECT `msg` FROM `messages`');

while($row=mysqli_fetch_assoc($sql)){
          
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
    
    
    else if($st5==$st6){
    
        $mess= '
        <video width="200px" height="200px" controls>
            <source src="videos/'.$msg.'">
       </video>
        ';
        
    }
    else
    {
        $mess=$row['msg'];

    }
    echo $mess;
}




?>