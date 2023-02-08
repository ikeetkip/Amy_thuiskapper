<?php
//Als er  op SUBMIT gedrukt is
//      Als de data waar is
//      Per data een error message tonen als het niet ingevuld is
//               een query voor INSERT van de tabel reservations
//                    Query uitvoeren op de database
//                    ALS correct uitgevoerd
//                            Redirect naar index.php
//                     Niet correct uitgevoerd
//                           Foutmelding tonen
//                     DB sluiten

require_once 'databaseQuery.php';
require_once "secure.php";


$errors = [];

if (isset($_POST['submit'])) {
    $name = mysqli_escape_string($db,$_POST['name']);
    $email = mysqli_escape_string($db,$_POST['email']);
    $phone_number = mysqli_escape_string($db,$_POST['phone_number']);
    $datetime = mysqli_escape_string($db,$_POST['datetime']);
    $treatment = mysqli_escape_string($db,$_POST['treatment']);

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



    if (empty($errors)){
        // toevoegen aan DB

        $query = "INSERT INTO reservations (name,email,phone_number,datetime,treatment)
                    VALUES ('$name', '$email', '$phone_number', '$datetime', '$treatment')";
        $result = mysqli_query($db, $query);


        if($result){
            header('Location: index.php');
            mysqli_close($db);
            exit();
        }else{
           die(mysqli_error($db));
        }
    }

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
    <title>Reservering </title>
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
    <h1 class="title mt-4 is-centered">Maak een nieuwe afspraak voor een knipbeurt</h1>
    <section class="columns">
        <form class="column is-6" action="" method="post">
            <div class="field is-horizontal">

                <div class="field-label is-normal">
                    <label class="label" for="name">Naam</label>
                </div>
                <div class="field-body">
                    <input class="input" id="name" type="text" name="name" value="<?= isset($name) ? htmlentities($name) : ''?>"/>
                </div>
            </div>


            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="email">Email</label>
                </div>
                <div class="field-body">
                    <input class="input" id="email" type="text" name="email" value="<?= isset($email) ? htmlentities($email) : ''?>"/>
                </div>
            </div>


            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="phone_number">TelefoonNummer</label>
                </div>
                <div class="field-body">
                    <input class="input" id="phone_number" type="text" name="phone_number" value="<?= isset($phone_number) ? htmlentities($phone_number) : ''?>"/>
                </div>
            </div>



            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="datetime">Datum&tijd</label>
                </div>
                <div class="field-body">
                    <input class="input" id="datetime" type="datetime-local" name="datetime" value="<?= isset($datetime) ? htmlentities($datetime) : ''?>"/>
                </div>
            </div>




            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="treatment">Behandeling</label>
                </div>
                <div class="field-body">
                    <input class="input" id="treatment" type="text" name="treatment" value="<?= isset($treatment) ? htmlentities($treatment) : ''?>"/>
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
    <a class="button mt-4" href="index.php">&laquo; Terug naar home pagina</a>
</div>
</div>
</body>
</html>
