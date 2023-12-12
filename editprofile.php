<?php
include_once "backend/connection.php";
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location:login_sign.php");
}
$receive = $_SESSION['unique_id'];
$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `unique_id`='$receive'");
$row = mysqli_fetch_row($query);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Profile Page</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
</head>

<body>
    <div class="header__wrapper">
        <header></header>
        <div class="cols__container">
            <div class="left__col">
                <div class="img__container">
                    <img src="backend/images/<?php echo $row['6'] ?>" alt="Anna Smith" />
                    <span
                        style="<?php echo ($row['9'] == "offilne") ? ("background-color: red") : ("display:block;"); ?>""></span>
                </div>
                <h2><?php echo $row[2] . " " . $row[3]; ?></h2>
                <p><?php echo $row['9']; ?></p>
                <p><?php echo $row['8'] ?></p>

                <ul class=" about">
                        <!-- <li><span>4,073</span>Followers</li> -->
                        <li><span>Count</span>Friends</li>
                        <!-- <li><span>200,543</span>Attraction</li> -->
                        </ul>

                        <div class="content">
                            <p>
                               <b>Bio:&nbsp </b><big><?php echo $row[12]?></big>
                            </p>

                            <!-- <ul>
            <li><i class="fab fa-twitter"></i></li>
            <i class="fab fa-pinterest"></i>
            <i class="fab fa-facebook"></i>
            <i class="fab fa-dribbble"></i>
          </ul> -->
                        </div>
                </div>
                <div class="right__col">
                    <nav>
                        <ul>
                            <li><a href="#" onclick="showAbout()">ABOUT</a></li>
                            <li><a href="#" onclick="showReports()">REPORTS</a></li>
                        </ul>
                        <button id="editBtn">Edit Profile</button>
                    </nav>

                    <div class="container">
                        <div class="about">

                            <div class="details active" id="about" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>User Id</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row[1] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row[2] . " " . $row[3]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row[5] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Verification</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row[8] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Profession</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row[11]?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Today Note</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row[13]?></p>
                                    </div>
                                </div>
                            </div>

                            <div id="editProfile">
                                <form action="#" id="editFlex" method="post" class="form">
                                    Firist Name : <input type="text" value="<?php echo $row[2]; ?>" name="fname"
                                        placeholder="First Name">
                                    Last Name : <input type="text" name="lname" value="<?php echo $row[3]; ?>"
                                        id="lastname" placeholder="Last Name">
                                    About : <textarea cols="40" rows="5" name="about"><?php echo $row[10]; ?></textarea>
                                    Profession : <input type="text" name="profession" value="<?php echo $row[11]; ?>"
                                        id="lastname" placeholder="Profession">
                                        Bio : <textarea cols="50" rows="6" name="bio"><?php echo $row[12]; ?></textarea>
                                    Today Note : <textarea cols="50" rows="6" name="note"><?php echo $row[13]; ?></textarea>
                                    Profile : <input id="profileUpload" type="file" value="" name="image">
                                    <input type="button" name="btn" value="Update" id="updateprofile">
                                    <input type="reset" name="resetBtn" value="Reset" id="">
                                </form>
                            </div>
                        </div>
                        <div class="reports" id="reports">
                            Reports Appear here
                        </div>

                    </div>
                </div>
            </div>
        </div>
</body>
<script src="js/updateprofile.js"></script>
<script>
const about = document.getElementById("about");
const reports = document.getElementById("reports");
const editBtn = document.getElementById("editBtn");
const editProfileBlock = document.getElementById("editProfile");

function showAbout() {
    about.style.display = 'block';
    reports.style.display = 'none';
    editProfileBlock.style.display = 'none';
}

function showReports() {
    about.style.display = 'none';
    reports.style.display = 'block';
    editProfileBlock.style.display = 'none';
}

editBtn.onclick = () => {
    about.style.display = 'none';
    reports.style.display = 'none';
    editProfileBlock.style.display = 'block';
}
</script>

</html>