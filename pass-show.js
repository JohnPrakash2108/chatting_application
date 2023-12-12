const pswrdfile=document.querySelector(".form .field input[type='password']");
togglebtn=document.querySelector(".form .field i");

togglebtn.onclick=()=>{
    if(pswrdfile.type=="password")
    {
        pswrdfile.type="text";
        togglebtn.classList.add("active");
    }
    else{
        pswrdfile.type="password";
        togglebtn.classList.remove("active");
    }
}