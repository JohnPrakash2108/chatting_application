// const signinform = document.querySelector(".sign-in-form"),
//     textfield = document.querySelector(".input-field #login_email"),
//     loginpass = document.querySelector(".input-field #login_pass"),
//     loginbtn = document.getElementById("login-btn"),
//     error_txt = document.getElementById("login_error-text");
// loginbtn.onsubmit = (event) => {
//     event.preventDefault();
// }
// loginbtn.onclick = () => {
//     const xhm = new XMLHttpRequest();
//     xhm.open("POST", "phpfile", true);
//     xhm.onload = () => {
//         if (xhm.status == 200) {
//             if (data == "success") {
//                 location.href = "php/users_page";
//             }
//             else {
//                 error_txt.style.display = "block";
//                 error_txt.innerHTML = xhm.responseText;
//             }
//         }
//     }
// }


const form = document.querySelector(".sign-up-form");
const signupbtn = document.getElementById("signup_btn");
let error_txt = document.getElementById("error-text");
form.onsubmit = (event) => {
    event.preventDefault();
}
signupbtn.onclick = () => {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/signup.php", true);
    xhr.onload = () => {

        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (xhr.response == "success") {
                    alert("ok");
                    location.href = "verify.php";//users.php
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