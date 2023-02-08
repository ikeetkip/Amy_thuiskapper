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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <script src="javascript/javascript.js"></script>
    <title>Amy thuiskapper</title>
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
    <div class="containerIMG">
        <!--Area of the images-->
        <div class="wrapper">
            <img src="img/zaak.jpg" alt="amy thuiskapper zaak">
            <img src="img/witenrood.jpg" alt=" wit en rood haar">
            <img src="img/shortkorea.jpg" alt="korea style hair">
            <img src="img/kids.jpg" alt="kids hair style">
        </div>

    </div>



</main>



</body>
</html>

