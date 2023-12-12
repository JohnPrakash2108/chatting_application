<?php include_once "header.php";
session_start();

if (!isset($_SESSION['unique_id'])) {
    header("location:login_sign.php");
} else {
    $unique = $_SESSION['unique_id'];
    $sqlquery = mysqli_query($conn, "SELECT `status` FROM `users` WHERE `unique_id` = '$unique' ");
    $rows = mysqli_fetch_row($sqlquery);
    if ($rows['status'] == "offline") {
        header("location:login_sign.php");
    }
}

?>

<head>

</head>

<body>
    <div class="container" id="cont">
        <header>
            <?php
            include_once "backend/connection.php";


            $sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `unique_id` = {$_SESSION['unique_id']}");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_row($sql);
            }
            ?>
            <div class="content">
                <img src="backend/images/<?php echo $row[6]; ?>" alt=" no image" width="15px" height="15px">
                <div class="details">
                    <span><?php echo $row[2] . " " . $row[3]; ?></span>
                    <p><?php echo $row[9] ?></p>
                    <a href="backend/logout.php?logout_id=<?php echo $row[1]; ?>" class="logout">Logout</a>
                </div>
            </div>

        </header>

        <div id="users-container">
            <input id="id-search" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome" type="text">
            <div id="title">
                Friends
            </div>
            <div id="usersList">
                <!-- <span class="user active" style="display:block;"></span> -->
                <div class="users-list">
                    <!-- <a class="user" href="chat-fullpage.php?user_id=this id=" availuser">
                        <i class="fa fa-duotone fa-flag note-notify"></i>
                        <img src="backend/images/1669065088deepak.jpg" alt="profile" class=" user-profile">
                        <div class="info">
                            <div class="name"> 'Johnny'</div>
                            <div class="last-msg">Youn : Hey<span class="time"></span> </div>
                        </div>
                        <span class="count">1</span>
                        <i class="fas fa-circle"></i>
                    </a> -->

                </div>
            </div>


        </div>


    </div>
    </div>
</body>
<!-- <script src="js/users.js"></script> -->

<script>
var header = document.getElementById("usersList");
var btn = document.getElementById("send-btn");
var userSelected = document.getElementById("noUser");
var closeBtn = document.getElementById("close-btn");
var xchat = document.getElementById("chat");
var users = header.getElementsByClassName("user");

// for (var i = 0; i < users.length; i++) {
//     users[i].addEventListener("click", function() {
//         alert("ok");
//         var current = document.getElementsByClassName("active");
//         current[0].className = current[0].className.replace("active", "");
//         this.className += " active";
//         chat.style.visibility = 'visible';
//         userSelected.style.display = 'none';
//         var element = document.getElementById("cont");
//         var stil = window.getComputedStyle(element).getPropertyValue("background-color");
//         if (stil == 'rgb(255, 0, 0)') {
//             chat.style.transform = 'translate(-100%)';
//         } else {
//             chat.style.transform = 'translate(0%)';
//         }
//     });
// }
// closeBtn.addEventListener("click", function() {
//     chat.style.visibility = 'hidden';
//     userSelected.style.display = 'block';
//     for (var i = 0; i < users.length; i++) {
//         var current = document.getElementsByClassName("active");
//         current[0].className = current[0].className.replace("active", "");
//         users[0].className += " active";
//     }
//     var element = document.getElementById("cont");
//     var stil = window.getComputedStyle(element).getPropertyValue("background-color");
//     if (stil == 'rgb(255, 0, 0)') {
//         userSelected.style.display = 'none';
//     } else {
//         userSelected.style.display = 'block';
//     }
// });



const searchbar = document.getElementById("id-search");
const userslist = document.querySelector(".users-list");
searchbar.onkeyup = () => {
    let searchterm = searchbar.value;
    // lets start ajax
    if (searchterm != "") {
        searchbar.classList.add("active");
    } else {
        searchbar.classList.remove("active");
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/searchusers.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                userslist.innerHTML = data;

            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchterm=" + searchterm);
}
setInterval(() => {
    // lets start ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "backend/getusers.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (!searchbar.classList.contains("active")) {
                    userslist.innerHTML = data;
                }

            }
        }
    }
    xhr.send();
}, 500);
</script>

</html>