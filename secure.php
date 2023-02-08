<?php
session_start();

//als het session NIET bestaat dan voer je de code uit.
// als je niet ben ingelogd word je terug gestuurd naar de login pagina
if (!isset($_SESSION['loggedInUser'])){
    header("Location: login.php");
    exit;
}

?>