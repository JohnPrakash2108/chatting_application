const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");


var signup_pass = document.getElementById("signup-pass");
var show = document.getElementById("show");
var login_show = document.getElementById("login_show");
var login_hide = document.getElementById("login_hide");
var signup_email = document.getElementById("email");
var hide = document.getElementById("hide");
var fname = document.getElementById("fname");
var lname = document.getElementById("lname");
var error = document.getElementById("error-text");
var login_error = document.getElementById("login_error-text");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
  login_email.value = ""; //clear when clicked
  login_pass.value = "";
  login_error.innerHTML = "";
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
  signup_email.value = ""; //clear when clicked
  signup_pass.value = "";
  fname.value = "";
  lname.value = "";
  error.innerHTML = "";
});



// login form check 

var login_pass = document.getElementById("login-pass");
var login_email = document.getElementById("login_email");

const loginBtn = document.getElementById("login-btn");

let loginStatus;
let loginEmailStatus;
login_email.addEventListener('keyup', function () {
  if (login_email.value.length > 3) {
    if (!login_email.value.match('@gmail.com')) {
      login_error.innerHTML = "Must include @gmail.com";
      login_error.style.display = 'block';
      loginEmailStatus = false;
    }
    else {
      login_error.style.display = 'none';
      loginEmailStatus = true;
    }
  }
})

loginBtn.addEventListener("click", function () {
  if (login_email.value == "" && login_pass.value == "") {
    login_error.style.display = 'block';
    login_error.innerHTML = "All Fields Required !";
    loginStatus = false;
  }
  else if (loginEmailStatus == false) {
    login_error.style.display = 'block';
    login_error.innerHTML = "Must include @gmail.com";
    loginStatus = false;
  }
  else {
    login_error.style.display = 'none';
    login_error.innerHTML = "";
    loginStatus = true;
  }
})
// window.onload = function () {
//   sign_up_btn.click();
// }


// validation part 


show.addEventListener("click", function () {
  signup_pass.type = 'text';
  hide.style.display = 'block';
  show.style.display = 'none';
})
hide.addEventListener("click", function () {
  signup_pass.type = 'password';
  hide.style.display = 'none';
  show.style.display = 'block';
})

login_show.addEventListener("click", function () {
  login_pass.type = 'text';
  login_hide.style.display = 'block';
  login_show.style.display = 'none';
})
login_hide.addEventListener("click", function () {
  login_pass.type = 'password';
  login_hide.style.display = 'none';
  login_show.style.display = 'block';
})


let fnameStatus;
let lnameStatus;
let emailStatus;
let passStatus;
fname.addEventListener("keyup", function () {
  if (fname.value.match(/[0-9]/)) {
    error.innerHTML = "No Numbers in Password";
    error.style.display = 'block';
    fnameStatus = false;
  }
  else {
    error.innerHTML = "";
    error.style.display = 'none';
    fnameStatus = true;
  }
})

lname.addEventListener("keyup", function () {
  if (lname.value.match(/[0-9]/)) {
    error.innerHTML = "No Numbers in Password";
    error.style.display = 'block';
    lnameStatus = false;
  }
  else {
    error.innerHTML = "";
    error.style.display = 'none';
    lnameStatus = true;
  }
})

signup_email.addEventListener('keyup', function () {
  if (email.value.length > 3) {
    if (!email.value.match('@gmail.com')) {
      error.innerHTML = "Must include @gmail.com";
      error.style.display = 'block';
      emailStatus = false;
    }
    else {
      error.style.display = 'none';
      emailStatus = true;
    }
  }
})


signup_pass.addEventListener("keyup", function () {
  if (signup_pass.value.length < 7 || signup_pass.value.length > 10) {
    error.innerHTML = "Must be 8-10 Characters..."
    error.style.display = "block";
    passStatus = false;

  }
  else if (!signup_pass.value.match(/[A-Z]/)) {
    error.innerHTML = "Atleast 1 UpperCase Required"
    error.style.display = "block";
    passStatus = false;

  }
  else if (!signup_pass.value.match(/[a-z]/)) {
    error.innerHTML = "Atleast 1 LowerCase Required"
    error.style.display = "block";
    passStatus = false;

  }
  else if (!signup_pass.value.match(/[0-9]/)) {
    error.innerHTML = "Atleast 1 Number Required"
    error.style.display = "block";
    passStatus = false;

  }
  else if (!signup_pass.value.match(/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/)) {
    error.innerHTML = "Atleast 1 SpecialCharacter Required"
    error.style.display = "block";
    passStatus = false;

  }
  else {
    error.innerHTML = "";
    error.style.display = "none";
    passStatus = true;
  }
})

const signupbtn = document.getElementById("signup_btn");
signupbtn.addEventListener("click", function () {

  if (fnameStatus == true && lnameStatus == true && emailStatus == true && passStatus == true) {
    error.style.display = "none";
    error.innerHTML = "";

    // ajax here 


    let error_txt = document.getElementById("error-text");


    let xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/signup.php", true);
    xhr.onload = () => {

      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          if (xhr.response == "success") {
            alert("signup");
            location.href = "verify.php"; //users.php
          }
          else {
            error_txt.style.display = "block";
            error_txt.innerHTML = data;
          }
        }
      }

    }
    let formData = new FormData(form);
    xhr.send(formData);
  }


  else {
    error.style.display = "block";
    error.innerHTML = "Please Reach Requirements";
  }

})





