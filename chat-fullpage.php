<?php include_once "header.php";
include_once "backend/connection.php";
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location:login_sign.php");
}
$name = $_SESSION['unique_id'];
//  else {
//     $unique = $_SESSION['unique_id'];
//     $sqlquery = mysqli_query($conn, "SELECT `status` FROM `users` WHERE `unique_id` = '$unique' ");
//     $rows = mysqli_fetch_row($sqlquery);
//     if ($rows[0] == "offline") {
//         unset($_SESSION['unique_id']);
//         header("location:login_sign.php");
//     }
// }

$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$sql = mysqli_query($conn, "SELECT `profile_img`,`first_name`,`last_name`,`status`,`about`,`note` FROM `users` WHERE `unique_id` = '$user_id'");
$row2 = mysqli_fetch_row($sql);

$outgoing_id = $_SESSION['unique_id'];
$seen = mysqli_query($conn, "UPDATE `messages` SET `seen` = 1 WHERE `incoming_id` = '$outgoing_id' AND `outgoing_id` = '$user_id'")
?>

<head>
    <link rel="stylesheet" href="css/chat-fullpage.css">
   
</head>

<body>

    <div class="container" id="cont">
        <div id="profile-container">
            <div class="headerProfile">
                <div class="topProfile">
                    <i id="closeProfile-btn" class="fa-duotone fa fa-xmark"></i>
                    <img src="backend/images/<?php echo $row2[0]; ?>" alt="profile" class=" userPage-profile">
                    <div class="name-status">
                        <div class="Profilename"><?php echo $row2[1] . " " . $row2[2]; ?></div>
                        <div class="Profilestatus"><?php echo $row2[3]; ?></div>
                        <div class="Profileabout"><?php echo $row2[4]; ?></div>
                    </div>
                </div>
                <div class="rightProfileOpt">
                    <a href="VIDEO CALL/index.php" target="_BLANK" onclick="" id="videoCall-btn" ><i class="fa-solid fa-video"></i></a>
                    <!-- <div class="menu-nav" id="show">
                        <div class="menu-item"></div>
                        <div class="dropdown-container" id="dropdown-opt" tabindex="-1">
                            <div class="three-dots"></div>
                            <div class="dropdown" id="showDropdown">
                                <a class="option" href="#">
                                    <div class="opt-name">Info</div>
                                </a>
                                <a class="option" href="#">
                                    <div class="opt-name">Report</div>
                                </a>
                                <a class="option" href="#">
                                    <div class="opt-name">Block</div>
                                </a>
                                <a class="option" href="#">
                                    <div class="opt-name">Clear Chat</div>
                                </a>
                                <a class="option" href="#">
                                    <div class="opt-name">Dissappear Chat</div>
                                </a>
                                <a class="option" href="#">
                                    <div class="opt-name">Hide Chat</div>
                                </a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>



        <div id="chat" style="visibility: visible;">
            <div class="headerChat">
                <div class="left-head">
                    <i id="close-btn" class="fa-duotone fa fa-xmark"></i>
                    <img src="img/profile.png" alt="profile" class=" user-profile">
                    <div class="name-status">
                        <div class="name">Lucky</div>
                        <div class="status last-msg">Active</div>
                    </div>
                </div>
                <div class="right-head">
                    <a href="#" id="videoCall-btn"><i class="fa-solid fa-video"></i></a>
                    <div class="menu-nav" style="display: flex;">
                        <div class="menu-item"></div>
                        <div class="dropdown-container" tabindex="-1">
                            <div class="three-dots"></div>
                            <div class="dropdown">
                                <a class="option" href="#">
                                    <div class="opt-name">IncoChat</div>
                                </a>
                                <a class="option" href="#">
                                    <div class="opt-name">Report</div>
                                </a>
                                <a class="option" href="#">
                                    <div class="opt-name">Block</div>
                                </a>
                                <a class="option" href="#">
                                    <div class="opt-name">Clear Chat</div>
                                </a>
                                <a class="option" href="#">
                                    <div class="opt-name">Dissappear Chat</div>
                                </a>
                                <a class="option" href="#">
                                    <div class="opt-name">Hide Chat</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="note">
                <marquee scrollamount="3"><?php echo  $row2[5]?></marquee>
                <div class="menu-nav" id="noteDropdown">
                    <div class="menu-item"></div>
                    <div class="dropdown-container" tabindex="-1">
                        <div class="three-dots"></div>
                        <div class="dropdown">
                            <a class="option" href="incoChat.php">
                                <div class="opt-name">Incochat</div>
                            </a>
                            <a class="option" href="#">
                                <div class="opt-name">Report</div>
                            </a>
                            <a class="option" href="#">
                                <div class="opt-name">Block</div>
                            </a>
                            <a class="option" href="#"  class="opt-name">
                            <div class="opt-name" onclick="clear_chat()">Clear Chat</div>
                                
                               
                            </a>
                            <a class="option" href="#">
                                <div class="opt-name">Dissappear Chat</div>
                            </a>
                            <a class="option" href="#">
                                <div class="opt-name">Hide Chat</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="msgContainer">
                <div class="no-lap">
                    <div class="received msg">
                        <span class="content"></span>
                        <span class="time">
                        </span>
                    </div>
                </div>


                <div class="no-lap">
                    <div class="sent msg">
                        <span class="content"></span>

                        <span class="time">
                        </span>
                    </div>




                </div>
            </div>
            <div class="send-section">

                <form action="#" method="post" class="send-form" enctype="multipart/form-data">
                    <div class="input--file">

                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="3.2" />
                                <path
                                    d="M9 2l-1.83 2h-3.17c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-12c0-1.1-.9-2-2-2h-3.17l-1.83-2h-6zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z" />
                                <path d="M0 0h24v24h-24z" fill="none" />
                            </svg>
                        </span>
                        <input type="file"  name="file" class="file" onchange="sendImg(this)" accept="image.*"/>
                        <!-- <input type="file" id="imagefile" name="file" onchange="sendImg(this)" accept="image.*"></input> -->
                        <input type="reset" value="reset" name="resetBtn" id="resetbtn" hidden>
                    </div>
                    <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                    <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" name="message" onkeyup="ChangeSendIcon(this)" placeholder="Type a Message ..."
                        id="type-box">
                    <div class="sendIcon">

                        <button id="send-btn" class="btn" style="display:none;"><i
                                class="fa fa-paper-plane"></i></button>
                        <button id="audio" class="btn"><i class="fas fa-microphone" onClick="record()"></i></button>


                        <?php $_SESSION['friend_id'] = $user_id; ?>


                        <!-- <button class="btn" id="send-btn"><i class="fa fa-duotone fa-paper-plane"></i></button>
                        <button class="btn" id="send-btn"><i class="fa fa-duotone fa-paper-plane"></i></button> -->
                    </div>
                </form>
            </div>
        </div>

    </div>
    </div>
</body>
<script src="js/getChat.js"></script>
<script>
var closeBtn = document.getElementById("close-btn");
var dropdown = document.getElementById("dropdown-opt");
var showDrop = document.getElementById("showDropdown");
var closeProfileBtn = document.getElementById("closeProfile-btn");


closeBtn.addEventListener("click", function() {
    location.href = "home.php";
});
// dropdown.addEventListener("click", function() {
//     // showDrop.style.opacity = '1';
//     alert('ok')
// });
closeProfileBtn.addEventListener("click", function() {
    location.href = "home.php";
});





function ChangeSendIcon(ctrl) {
    if (ctrl.value !== '') {
        document.getElementById("send-btn").removeAttribute("style");
        document.getElementById("audio").setAttribute("style", "display:none");
    } else {
        document.getElementById("audio").removeAttribute("style");
        document.getElementById("send-btn").setAttribute("style", "display:none");
    }

}

function record() {

    var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

    var msg = document.getElementById("type-box");

    var recognition = new SpeechRecognition();
    var content = '';
    recognition.start();

    recognition.onstart = function() {
        msg.value = "Start talk.....";
    }
    if (content.length) {
        msg.value = "";
    }
    recognition.onspeechend = function() {
        msg.value = "";
    }
    recognition.onresult = function(event) {
        console.log(event);
        document.getElementById("send-btn").removeAttribute("style");
        document.getElementById("audio").setAttribute("style", "display:none");
        const spokewords = event.results[0][0].transcript;
        content += spokewords;
        console.log(content);
        msg.value = content;

    }

}
function sendImg(ctrl) {
        var file = ctrl.files[0];
        if (!file.type.match("image.*")) {
                alert("Please select image only.");
        }
         else {
        document.getElementById("type-box").value = "Send Your Image";
        document.getElementById("send-btn").removeAttribute("style");
        document.getElementById("audio").setAttribute("style", "display:none");
         }
    }


    function clear_chat()
{
             var cust = prompt("Enter Time(Only seconds): ");
             if(cust!=null)
             {
             var settime=setInterval(() => {
                let xhr5=new XMLHttpRequest();
                xhr5.open("GET","backend/chooseDelete.php?outgoing="+<?php echo $name;?>+"&incoming="+<?php echo $user_id;?>+"",true);
              
                xhr5.send();
                
            }, cust*1000);
             }
           
        
       
    }
   
    

</script>
