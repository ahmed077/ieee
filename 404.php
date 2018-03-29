<?php
$title = '404';
$caption = '';
$returnTop = false;
require_once 'includes/init.php';
?>
    <style>
        .site-header{
            background:rgb(0, 66, 150);
            position: static;
            margin:0 0 50px;
            padding:30px 50px;
            width:100%;
        }
        @media(max-width:400px) {
            .site-header {
                padding-left: 0;
                padding-right: 0;
            }
        }
        .404-hero {
            position: relative;
            margin: 0 0 40px;
            min-height: 364px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .404-hero:after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background: rgba(0, 66, 150, 0.9)
        }

        .404-hero .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .404-hero .hero-content h2 {
            font-size: 33px;
            color: #333;
            font-family: "Montserrat-Light";
            margin: 0 0 20px;
        }
        .main {
            display:flex;
            justify-content: center;
            flex-direction:column;
            align-items: center;
            padding-bottom:40px;
        }
    </style>
<div class="main">
    <img src="images/broken-pencil-cliparts.png" width="729" alt="404">
    <h2 style="font-size:100px;">404</h2>
    <p class="lead">Oops... Page not Found.</p>
</div>
<?php
require_once 'partials/footer.html';
?>