<?php

//database connectie maken
// als de id is niet aangegeven, redirect terug naar de homepage

//een nieuwe variable aanmaken met _GET om de id te hebben
  // een query maken om alles van de tabel reservations op te halen

// als de reservation niet bestaat, redirect terug naar de homepage

//een row zetter in een php array, met mysqli_fetch_assoc



/** @var $db */
require_once 'databaseQuery.php';
require_once "secure.php";


if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: reservations.php');
    exit;
}

$klantId = $_GET['id'];


$query = "SELECT * FROM reservations WHERE id = " . $klantId;
$result = mysqli_query($db, $query);


if (mysqli_num_rows($result) == 0) {
    header('Location: reservations.php');
    exit;
}

$row = mysqli_fetch_assoc($result);


mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Details - <?= $row['name'] ?></title>
</head>
<body>


<div class="container px-4">
    <div class="box m-6 is-orange is-rounded-soft">

    <section class="content">
        <ul>
            <li>Naam: <?= $row['name'] ?></li>
            <li>Email: <?= $row['email'] ?></li>
            <li>Telefoonnummer: <?= $row['phone_number'] ?></li>
            <li>Datum: <?= $row['datetime'] ?></li>
            <li>Behandeling: <?= $row['treatment'] ?></li>
        </ul>
    </section>
    <div>
        <a class="button" href="reservations.php">Terug naar overzicht</a>
    </div>
</div>
</div>
</body>
</html>

