const form = document.getElementById("send-form"),
    inputfield = document.getElementById("type-box"),
    sendbtn = document.getElementById("send-btn"),
    chatbox = document.querySelector(".msger-chat");
// resetBtn = document.getElementById("resetbtn")


form.onsubmit = (e) => {
    e.preventDefault();
}

sendbtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "incoChat/insert-chat.php", true);
    xhr.onload = () => {

        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {

                inputfield.value = "";
                scrolljohn();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatbox.onmouseenter = () => {
    chatbox.classList.add("active");
}
chatbox.onmouseleave = () => {
    chatbox.classList.remove("active");
}
const myTimeout = setInterval(myGreeting, 500);

function myGreeting() {
    let xhr2 = new XMLHttpRequest();
    xhr2.open("POST", "incoChat/getChat.php", true);
    xhr2.onload = () => {
        if (xhr2.readyState === XMLHttpRequest.DONE) {
            if (xhr2.status === 200) {
                let data = xhr2.response;
                chatbox.innerHTML = data;
                if (!chatbox.classList.contains("active")) {
                    scrolljohn();
                }
            }
        }
    }
    let formData2 = new FormData(form);
    xhr2.send(formData2);
}




function scrolljohn() {
    chatbox.scrollTop = chatbox.scrollHeight;
}

window.onhashchange = function () {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "incoChat/incodelete.php", true);
    xhr.onload = () => {

        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {

            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

