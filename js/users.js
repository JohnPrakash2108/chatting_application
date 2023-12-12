// // const users = document.querySelector(".users");

// userslist = document.querySelector(".users-list");

// setInterval(() => {
//     // lets start ajax
//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", "backend/getusers.php", true);
//     // alert("hey");
//     xhr.onload = () => {
//         // alert("hl000o");
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 let data = xhr.response;
//                 userslist.innerHTML = data;
//             }
//         }
//     }
//     xhr.send();
//     // let formData = new FormData(form);
//     // xhr.send(formData);\
// }, 500);