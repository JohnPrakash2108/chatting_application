const form=document.querySelector(".login form"),
continuebtn=form.querySelector(".button input"),
forgot=document.getElementById("forgot"),
errorText=form.querySelector(".error-txt");

form.onsubmit=(e)=>{
    e.preventDefault();
}
forgot.onclick=()=>{
    location.href="http://localhost/chat%20application/forgot.php";
}
continuebtn.onclick=()=>{
    // lets start ajax
    let xhr=new XMLHttpRequest();
    xhr.open("POST","php/login.php",true);
    xhr.onload=()=>{
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                let data=xhr.response;
                console.log(data);
                if(data == "verify")
                {
                    location.href= "http://johnprakashjp.000webhostapp.com/verify.php";
                }
                else if(data=="success")
                {
                    location.href= "users.php";
                }
                else{
                        errorText.style.display="block";
                        errorText.textContent=data;
                }
            }
        }
    }
    let formData=new FormData(form);
    xhr.send(formData);
}