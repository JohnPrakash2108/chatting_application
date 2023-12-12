<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    header("location:home.php");
}
$otp = rand(111111, 999999);
$_SESSION['otp'] = $otp;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login_style.css" />
    <title>Sign in & Sign up Form</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="#" method="post" class="sign-in-form">
                    <h2 class="title">Login</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" name="login_email" id="login_email" placeholder="Email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="login_password" id="login-pass" placeholder="Password" />
                    </div>
                    <p><a style="text-decoration: none;" href="forgot.php">Forgot Password ?</a></p>
                    <div id="login_showIcon">
                        <i id="login_show" class="fa fa-solid fa-eye"></i>
                        <i id="login_hide" class="fa fa-solid fa-eye-slash"></i>
                    </div>
                    <p id="login_error-text"></p>
                    <input type="submit" value="Login" id="login-btn" class="btn solid" />
                    <!-- <a href="/landing-page.html" class="btn solid">Login</a> -->
                </form>



                <form action="#" method="post" class="sign-up-form" enctype="multipart/form-data">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="fname" name="fname" placeholder="First Name" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="lname" name="lname" placeholder="Last Name" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="Email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="signup-pass" maxlength="10" placeholder="Password" />
                    </div>
                    <div id="showIcon">
                        <i id="show" class="fa fa-solid fa-eye"></i>
                        <i id="hide" class="fa fa-solid fa-eye-slash"></i>
                    </div>
                    <input type="file" name="file" style="position: relative; top: -20px;  left: -30px;">
                    <p id="error-text"></p>
                    <input type="submit" name="signupbtn" class="btn" id="signup_btn" value="Sign up" />
                </form>



            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        Common SignUp and Start Chatting With Friends
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Already having an Account ?</h3>
                    <p>
                        Why waiting !! Lets Chat ... Come and Login
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="js/app.js"></script>
    <!-- <script src="js/signup.js"></script> -->
</body>
<script>
    const form = document.querySelector(".sign-up-form");

    form.onsubmit = (event) => {
        event.preventDefault();
    }

    const login_form = document.querySelector(".sign-in-form");

    login_form.onsubmit = (event) => {
        event.preventDefault();
    }






    const loginbtn = document.getElementById("login-btn");

    loginbtn.addEventListener("click", function() {
        const emailfield = document.getElementById("login_email").value,
            password = document.getElementById("login-pass").value;
        const errortxt = document.getElementById("login_error-text");
        if (emailfield !== "" && password !== "") {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "backend/login.php", true);
            xhr.onload = () => {

                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if (xhr.response == "success") {
                            location.href = "home.php"; //users.php
                        } else if (data == "verify") {
                            location.href = "verify.php";
                        } else {
                            errortxt.style.display = "block";
                            errortxt.innerHTML = data;
                        }
                    }
                }

            }
            let formData = new FormData(login_form);
            xhr.send(formData);

        } else {

            errortxt.style.display = "block";
            errortxt.innerHTML = "All fields are required";
        }
    })
</script>

</html>