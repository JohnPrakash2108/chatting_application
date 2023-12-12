<?php 
   session_start();
   if(!isset($_SESSION['unique_id']))
   {
        header("location:login.php");
   }
   $name=$_SESSION['unique_id'];
  
?>

    <?php include_once "header.php"; ?>
<head>

</head>
<body>

    <div class="wrapper">
        <section class="chat-area">
            <header>
            <?php
                   include_once "config.php";
                   $user_id=mysqli_real_escape_string($conn, $_GET['user_id']);
                   $sql=mysqli_query($conn,"SELECT * FROM `users` WHERE `unique_id` = {$user_id}");
                   if(mysqli_num_rows($sql)>0)
                   {
                         $row=mysqli_fetch_assoc($sql);
                   }
                ?>
                  <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                   <img src="php/imges/<?php echo $row['img']; ?>" alt="">
                   <div class="details">
                       <span><?php echo $row['fname']." ".$row['lname']?></span>
                       <p id="dot"><?php echo $row['status']?></p>
                       
                   </div>
                   <div class="dropdown" style="z-index:100">
                   <form action="#" class="photo-area" enctype="multipart/form-data">
                            <i style="cursor:pointer;" class="fas fa-paperclip"></i>
                                <select onchange="chooseImage()">
                                    <option></option>
                                    <option value="image">Image</option>
                                <select>
                                                        
                                <select onChange="chooseDelete()" id="opt">
                                    
                                    <option value="delete">Delete</option>
                                    <option value="5sec">5 sec</option>
                                    <option value="20sec">20sec</option>
                                    <option value="1min">1min</option>
                                    <option value="cust">Custom</option>
                                    
                                <select>
                               
                      </form>
                      
                </div>
               
            </header>
           
            
           
            
        
             
             <div class="chat-box" style="background-image:url('ooooo.jpg');">
              
             </div>
             <form action="#" class="typing-area" enctype="multipart/form-data">
                 <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'];?>"  hidden>
                 <input type="text" name="incoming_id" value="<?php echo $user_id; ?>"  hidden>

                
                
                 <input type="text" name="message" class="input-field" id="msg" onkeyup="ChangeSendIcon(this)" placeholder="Type a message here...">
                 <label style="display:none">
                        <input input type="file" id="imagefile" name="file" onchange="sendImg(this)" accept="image.*"></input>
                </label>  
                 <button id="send" style="display:none;"><i class="fa fa-paper-plane"></i></button>
                 <button id="audio"><i class="fas fa-microphone" onClick="record()" onChange="ChangeSendIcon(this)"></i></button>
                
             </form>
              
             
        </section>
    </div>
    
    
    <script>
         
            function ChangeSendIcon(ctrl){
                if(ctrl.value!=='')
                {
                    document.getElementById("send").removeAttribute("style");
                    document.getElementById("audio").setAttribute("style","display:none");
                }
                else{
                    document.getElementById("audio").removeAttribute("style");
                    document.getElementById("send").setAttribute("style","display:none");
                }
                
            }
            function record()
            {
                
            var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

            var msg=document.getElementById("msg");
            
            var recognition= new SpeechRecognition();
            var content = '';
            recognition.start();
           
            recognition.onstart = function(){
                msg.value="Start talk.....";
            }
            if(content.length)
            {
               msg.value="";
            }
            recognition.onspeechend = function(){
                msg.value="";
            }
            recognition.onresult=function(event){
            console.log(event);
            document.getElementById("send").removeAttribute("style");
                    document.getElementById("audio").setAttribute("style","display:none");
            const spokewords=event.results[0][0].transcript;
            content+=spokewords;
            console.log(content);
            msg.value=content;
   
            }

            }

            function chooseImage()
            { 
                document.getElementById("imagefile").click();
            }
            function sendImg(ctrl)
            {
                var file = ctrl.files[0];
                if (!file.type.match("image.*")) {
                        alert("Please select image only.");
                }
                 else {
                    document.getElementById("msg").value="Send Your Image";
                    document.getElementById("send").removeAttribute("style");
                    document.getElementById("audio").setAttribute("style","display:none");
               }
            }
            function chooseDelete(event)
            {
                var ele = document.getElementById("opt").value;
                var settime=setInterval(() => {});
                if(ele=="5sec")
                {
                    var settime=setInterval(() => {
                        
                            
                        let xhr5=new XMLHttpRequest();
                        xhr5.open("GET","php/chooseDelete.php?outgoing="+<?php echo $name;?>+"&incoming="+<?php echo $user_id;?>+"",true);
                        
                        xhr5.send();
                        
                    }, 5000);
                  
                }
                else if(ele=="20sec")
                {
                    var settime=setInterval(() => {
                    
                            
                        let xhr5=new XMLHttpRequest();
                        xhr5.open("GET","php/chooseDelete.php?outgoing="+<?php echo $name;?>+"&incoming="+<?php echo $user_id;?>+"",true);
                        
                        xhr5.send();
                        
                    }, 20000);
                   
                }
                else if(ele=="1min")
                {
                    var settime=setInterval(() => {
                        
                        
                        
                        let xhr5=new XMLHttpRequest();
                        xhr5.open("GET","php/chooseDelete.php?outgoing="+<?php echo $name;?>+"&incoming="+<?php echo $user_id;?>+"",true);
                        
                        xhr5.send();
                        
                    }, 100000);
                   
                }
                else if(ele=="cust")
                {
                     var cust = prompt("Enter Time(Only seconds): ");
                     if(cust!=null)
                     {
                     var settime=setInterval(() => {
                        
                        
                        
                        let xhr5=new XMLHttpRequest();
                        xhr5.open("GET","php/chooseDelete.php?outgoing="+<?php echo $name;?>+"&incoming="+<?php echo $user_id;?>+"",true);
                        
                        xhr5.send();
                        
                    }, cust*1000);
                     }
                   
                }
                else if(ele=="delete")
                {
                    clearInterval(settime);
                }
            }
           
            
            </script>
    <script src="userchat.js"></script>
  
</body>
</html>
