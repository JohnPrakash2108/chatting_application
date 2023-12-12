const searchbar=document.querySelector(".users .search input"),
searchbtn=document.querySelector(".users .search button"),
userslist=document.querySelector(".users .users-list");

searchbtn.onclick=()=>{
    searchbar.classList.toggle("active");
    searchbar.focus();
    searchbtn.classList.toggle("active");
}

setInterval(()=>{
    // lets start ajax
    let xhr=new XMLHttpRequest();
    xhr.open("POST","./users.php.php",true);
    xhr.onload=()=>{
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                let data=xhr.response;
                userslist.innerHTML=data;
            }
        }
    }
    let formData=new FormData(form);
    xhr.send(formData);
   
},500);