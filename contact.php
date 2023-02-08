<?php
require_once "secure.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <script src="javascript/javascript.js"></script>
    <title>Contact</title>
</head>
<body>
<header>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class= "logo-item" href="index.php">
                <img src="img/Logo_Amy1.PNG" alt="Amy thuiskapper logo" class="logo">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="index.php">
                    Home
                </a>

                <a class="navbar-item" href="prijzen.php">
                    Prijzen
                </a>
                <a class="navbar-item" href="contact.php">
                    Contact
                </a>
                <a class="navbar-item" href="foto.php">
                    foto's
                </a>
                <?php

                if (isset($_SESSION['loggedInUser']['admin'])){
                    ?>

                    <a class="navbar-item" href="details.php">
                        Afspraken
                    </a>
                <?php }?>
            </div>
            <?php

            if (!isset($_SESSION['loggedInUser'])){;
                ?>
                <div class="navbar-end">
                    <a class="navbar-item" href="register.php">
                        Register
                    </a>
                    <a class="navbar-item" href="login.php">
                        Login
                    </a>
                </div>
            <?php } ?>



            <?php

            if (isset($_SESSION['loggedInUser'])){;
                ?>
                <div class="navbar-end">
                    <a class="navbar-item" href="logout.php">
                        logout
                    </a>
                </div>
            <?php } ?>

        </div>
    </nav>
</header>

<main>
    <div class="box m-6 is-orange is-rounded-soft">
        <h1 class="title is-1 has-text-centered">Contact info</h1>

    <section class="is-justify-content-center is-align-content-center has-text-centered">
        <! -- phone -->
        <span class="icon-text ">
            <span class="icon">
                <i class="fas fa-phone" ></i>
                <p> 0626607530 </p>
            </span>
        </span>
        <br>

        <! -- email -->
        <span class="icon-text">
            <span class="icon">
                <i class="fa-solid fa-envelope"></i>
                <p> Amy.wu@live.nl</p>
            </span>
        </span>
        <br>

    </section>
        <div class="mapouter"><div class="gmap_canvas"><iframe width="400" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=zuiderkerkedijk%20168&t=&z=13&ie=UTF8&iwloc=&output=embed" >




    </div>
</main>
</body>
</html>

