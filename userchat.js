
const form=document.querySelector(".typing-area"),
inputfield=form.querySelector(".input-field"),
sendbtn=form.querySelector("button"),
chatbox=document.querySelector(".chat-box"),
imagefile=document.querySelector("#imagefile"),
img=document.querySelector(".image");

form.onsubmit=(e)=>{
    e.preventDefault();
}

sendbtn.onclick=()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("POST","insert-chat.php",true);
    xhr.onload=()=>{
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                document.getElementById("audio").removeAttribute("style");
                document.getElementById("send").setAttribute("style","display:none");
                
               inputfield.value="";
               scrolljohn();
            }
        }
    }
    let formData=new FormData(form);
    xhr.send(formData);
}
chatbox.onmouseenter=()=>{
    chatbox.classList.add("active");
}
chatbox.onmouseleave=()=>{
    chatbox.classList.remove("active");
}
const myTimeout = setInterval(myGreeting,500);

function myGreeting() {
    let xhr2=new XMLHttpRequest();
    xhr2.open("POST","php/get_chat.php",true);
    xhr2.onload=()=>{
        if(xhr2.readyState === XMLHttpRequest.DONE)
        {
            if(xhr2.status === 200)
            {
                let data=xhr2.response;
                chatbox.innerHTML=data;
                if(!chatbox.classList.contains("active"))
                {
                    scrolljohn();
                }
            }
        }
    }
    let formData2=new FormData(form);
    xhr2.send(formData2);
}
function deletechat(ctrl)
   {
    setTimeout(() => {
        var mess = confirm("Confirm to delete");
        if(mess)
        {
        let xhr5=new XMLHttpRequest();
        xhr5.open("GET","php/clear_chat.php?mess_id="+ctrl.id+"",true);
        
       xhr5.send();
    }}, 1000);
    
    }


   

function scrolljohn(){
    chatbox.scrollTop = chatbox.scrollHeight;
}
