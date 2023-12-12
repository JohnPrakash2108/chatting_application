<?php include_once "header.php";
session_start();
include_once "backend/connection.php";
if (!isset($_SESSION['unique_id'])) {
    header("location:login_sign.php");
 
} 
//else {
//     $unique = $_SESSION['unique_id'];
//     $sqlquery = mysqli_query($conn, "SELECT `status` FROM `users` WHERE `unique_id` = '$unique' ");
//     $rows = mysqli_fetch_row($sqlquery);
//     if ($rows[0] == "offline") {
//         unset($_SESSION['unique_id']);
//         header("location:login_sign.php");
//     }
// }


?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Website Landing Page Design</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="css/home-page.css">
</head>

<body>

    <section>
        <header>
            <?php


            $sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `unique_id` = {$_SESSION['unique_id']}");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_row($sql);
            }
            ?>
            <h2><a href="#" class="logo">Logo</a></h2>
            <div class="navigation">
                <a href="#" class="active">Home</a>
                <a href="#">Friends</a>
                <a href="/frontEnd/Responsive Card Slider/index.html">Add Strangers</a>
                <a href="#">About</a>
                <a href="backend/logout.php?logout_id=<?php echo $row[1]; ?>">Logout</a>
                <div class="icon" onclick="toggleNotifi()">
                    <img src="img/bell.png" alt=""> <span id="pushNotification"></span>
                </div>


                <div class="notifi-box" id="box">
                    <h2>Notifications <span></span></h2>
                    <div class="notifi-item">
                        <img src="img/avatar1.png" alt="img">
                        <div class="text">
                            <h4>Elias Abdurrahman</h4>
                            <p>@lorem ipsum dolor sit amet</p>
                        </div>
                    </div>

                    <div class="notifi-item">
                        <img src="img/avatar2.png" alt="img">
                        <div class="text">
                            <h4>John Doe</h4>
                            <p>@lorem ipsum dolor sit amet</p>
                        </div>
                    </div>

                   
                </div>
            </div>
        </header>
        <div class="container">


            <div class="content">
                <div class="info">
                    <img src="backend/images/<?php echo $row[6]; ?>" id="profile" alt="">
                    <h2><?php echo $row[2]; ?><br><span><?php echo $row[3]; ?></span></h2>
                    <p><?php echo $row[9] ?></p>
                    <a href="editprofile.php" class="info-btn">View Profile</a>
                </div>
            </div>
            <div id="users-container">
                <input id="id-search" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome" type="text">
                <div id="title">
                    Friends
                </div>
                <div id="usersList">
                    <div class="users-list">

                    </div>
                </div>
            </div>
    </section>

</body>
<script>
var box = document.getElementById('box');
var down = false;


function toggleNotifi() {
    if (down) {
        box.style.height = '0px';
        box.style.opacity = 0;
        down = false;
    } else {
        box.style.height = '510px';
        box.style.opacity = 1;
        down = true;
    }
}




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



setInterval(() => {
    // lets start ajax
    let xhr2 = new XMLHttpRequest();
    xhr2.open("GET", "backend/getNotifications.php", true);
    xhr2.onload = () => {
        if (xhr2.readyState === XMLHttpRequest.DONE) {
            if (xhr2.status === 200) {


                document.getElementById("pushNotification").innerHTML = xhr2.response;



            }
        }
    }
    xhr2.send();
}, 500);
</script>

</html>