<?php

// database ophalen
// query maken om alles te pakken van de tabel reservations
// een variable maken met een mysqli_query
// zet alles data in een array met de mysqli_fetch_assoc



require_once 'databaseQuery.php';
require_once "secure.php";


$query = "SELECT * FROM reservations";

/** @var mysqli $db */
$result = mysqli_query($db, $query)
    or die("Error:". $query);

while ($row = mysqli_fetch_assoc($result)) {
    $reservation[] = $row;
}




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

    <div class="box m-6 is-orange is-rounded-soft">
        <h1 class="title is-1 has-text-centered">Afspraken overzicht</h1>
    <table class="table ">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>email</th>
        <th>Telefoon_Nummer</th>
        <th>Datum</th>
        <th>Behandeling</th>
        <th></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($reservation as $index => $row) { ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone_number'] ?></td>
            <td><?= $row['datetime'] ?></td>
            <td><?= $row['treatment'] ?></td>
            <td><a href="details.php?id=<?= $row['id'] ?>">details</a></td>
            <td><a href="update.php?id=<?= $row['id'] ?>">Edit</a></td>
            <td><a href="delete.php?id=<?= $row['id'] ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    </div>

</body>
</html>
