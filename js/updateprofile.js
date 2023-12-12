const form = document.querySelector(".form"),
    updatebtn = document.getElementById("updateprofile"),
    profileUpdate = document.getElementById("profileUpdate");
form.onsubmit = (event) => {
    event.preventDefault();
}

// if (profileUpdate.value == null || profileUpdate.value == "") {
//     alert("kali")
// }


updatebtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/updateprofile.php", true);
    xhr.onload = () => {

        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;

                if (xhr.response == "success") {
                    alert("DATA UPDATED SUCCESSFULLY");
                    location.href = "editprofile.php";//users.php
                }
                else if (data == "fail") {
                    alert("Somethimg Went Wrong...");
                }
                else {
                    alert("Upload Failed");
                }
            }
        }

    }
    let formData = new FormData(form);
    xhr.send(formData);
}