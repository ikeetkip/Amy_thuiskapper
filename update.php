<?php

//database connectie maken

//id ophalen met _GET methode
    //alle gegevens ophalen van de database
    //een error maken als alle gegevens niet zijn ingevuld
            // een query maken om alle data te tonen van de database
    //de gegevens in een tabel tonen
// ALS er GEEN errors zijn
    // een query maken om de data te kunnen UPDATEN
        //na het aanpassen van de data redirect terug naar reservations.php
       //na het veranderen van de gegevens is het veranderd in de details.php en in phpmyadmin.
// ANDERS de data tonen en zetten in een array.


/* @var mysqli $db */

// database connectie
require_once 'databaseQuery.php';
require_once "secure.php";


$id = mysqli_escape_string($db,$_GET['id']);

if (isset($_POST['submit'])) {

    $name = mysqli_escape_string($db, $_POST['name']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $phone_number = mysqli_escape_string($db, $_POST['phone_number']);
    $datetime = mysqli_escape_string($db, $_POST['datetime']);
    $treatment = mysqli_escape_string($db,$_POST['treatment']);

$errors = [];

    if ($name == '' ){
        $errors[] = 'Naam moet gevuld zijn';
    }
    if ($email == ''){
        $errors[] = 'Email moet gevuld zijn';
    }
    if ($phone_number == ''){
        $errors[] = 'Telefoon nummer moet gevuld zijn';
    }
    if ($datetime == ''){
        $errors[] = 'Datum moet gevuld zijn';
    }
    if ($treatment == '' ){
        $errors[] = 'Behandeling moet gevuld zijn';
    }

    if (empty($errors)) {

        $datetime = str_replace('T', ' ', $datetime);


        $query = "UPDATE reservations
          SET name='$name', email='$email', phone_number = '$phone_number', datetime = '$datetime', treatment = '$treatment'
           WHERE id = '$id' ";

        $result = mysqli_query($db, $query);

        header('location: reservations.php');
        exit();
    }
}

else{
    $query = "SELECT * FROM reservations WHERE id = '$id' ";
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );
    $categories = mysqli_fetch_assoc($result);

}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Afspraak aanpassen</title>
</head>
<body>
<div class="container px-4">

    <?php if (!empty($errors)){ ?>
        <section class="content">
            <ul class="notification is-danger">
                <?php foreach ($errors as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php } ?>

    <div class="is-orange box is-rounded-soft">
        <h1 class="title mt-4 is-centered">een afspraak aanpassen</h1>
        <section class="columns">
            <form class="column is-6" action="" method="post">
                <div class="field is-horizontal">

                    <div class="field-label is-normal">
                        <label class="label" for="name">Naam</label>
                    </div>
                    <div class="field-body">
                        <input class="input" id="name" type="text" name="name" value="<?= $_POST['name'] ?? $categories['name'];?>"/>
                    </div>
                </div>


                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="email">Email</label>
                    </div>
                    <div class="field-body">
                        <input class="input" id="email" type="text" name="email" value="<?= $_POST['email'] ?? $categories['email'];?>"/>
                    </div>
                </div>


                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="phone_number">TelefoonNummer</label>
                    </div>
                    <div class="field-body">
                        <input class="input" id="phone_number" type="text" name="phone_number" value="<?= $_POST['phone_number'] ?? $categories['phone_number'];?>"/>
                    </div>
                </div>


                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="datetime">Datum&tijd</label>
                    </div>
                    <div class="field-body">
                        <input class="input" id="datetime" type="datetime-local" name="datetime" value="<?= $_POST['datetime'] ?? $categories['datetime'];?>"/>
                    </div>
                </div>


                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="treatment">Behandeling</label>
                    </div>
                    <div class="field-body">
                        <input class="input" id="treatment" type="text" name="treatment" value="<?=$_POST['treatment'] ?? $categories['treatment'];?>"/>
                    </div>
                </div>


                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth" type="submit" name="submit">Save</button>
                    </div>
                </div>
            </form>
        </section>
        <a class="button mt-4" href="reservations.php">&laquo; Terug naar afspraken</a>
    </div>
</div>
</body>
</html>
