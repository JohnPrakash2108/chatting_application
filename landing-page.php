<head>
    <link href="css/landing-page.css" rel="stylesheet">

</head>

<body>
    <div class="blob">
        <!-- This SVG is from https://codepen.io/Ali_Farooq_/pen/gKOJqx -->
        <svg xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 310 350">
            <path
                d="M156.4,339.5c31.8-2.5,59.4-26.8,80.2-48.5c28.3-29.5,40.5-47,56.1-85.1c14-34.3,20.7-75.6,2.3-111  c-18.1-34.8-55.7-58-90.4-72.3c-11.7-4.8-24.1-8.8-36.8-11.5l-0.9-0.9l-0.6,0.6c-27.7-5.8-56.6-6-82.4,3c-38.8,13.6-64,48.8-66.8,90.3c-3,43.9,17.8,88.3,33.7,128.8c5.3,13.5,10.4,27.1,14.9,40.9C77.5,309.9,111,343,156.4,339.5z" />
        </svg>
    </div>
    <div>
        <h1 id="title">CHIK CHIK BOOM</h1>
        <p>This enables us to communicate with other.. Hurry Up and Start Messaging !!</p>
    </div>
    <div id="content">
        <div class="image-gallery">
            <div class="images-container">

                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="img/first.jfif">
                    <div class="text">Caption Text</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="img/second.jfif">
                    <div class="text">Caption Two</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="img/third.jfif">
                    <div class="text">Caption Three</div>
                </div>
            </div>

            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
        <div class="info">

            <img class="image" src="img/compu.png" alt="Computer">
            <a href="../chik_chik_boom/login_sign.php" class="btn">Sign Up !!</a>
        </div>
    </div>
</body>

<script>
let slideIndex = 1;
showSlides(slideIndex);

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}

setInterval(function() {
    showSlides(slideIndex += 1);
}, 5000)
</script>

</html>