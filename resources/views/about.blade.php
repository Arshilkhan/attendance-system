<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>

<body>

    <nav-bar></nav-bar>

    <div class="team-member">
        <div class="profile">
            <img src="{{ asset('images/placeholder.jpg') }}">
            <h3>Zeeshan Shaikh</h3>
            <p class="title">CS Major / Jr. PHP Developer</p>
            <p class="about">
                Passionate about backend development and clean, efficient code.
                Currently building dynamic web applications using PHP and PostgreSQL.
            </p>
            <div class="socials">
                <a href="https://github.com/johndoe" target="_blank"><i class="fa-brands fa-github"></i></a>
                <a href="https://linkedin.com/in/johndoe" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                <a href="https://twitter.com/johndoe" target="_blank"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>


</body>

<foot-ter></foot-ter>

<script src="{{ asset('js/navbar.js') }}"></script> 
<script src="{{ asset('js/footer.js') }}"></script> 

</html>