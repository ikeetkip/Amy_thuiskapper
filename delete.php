<?php
//database connectie maken
//id ophalen
// een sql maken om een data uit de database kan verwijderen
// na het voldaan van taak terug naar reservations.php

/** @var $db */
require_once 'databaseQuery.php';

$id = mysqli_escape_string($db,$_GET['id']);

$query = "DELETE From reservations WHERE id = '$id'";
$result = mysqli_query($db, $query);

header('location: reservations.php');
exit();

?>