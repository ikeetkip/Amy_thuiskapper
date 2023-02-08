<?php
if(isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "databaseQuery.php";

    // Get form data
    $name = mysqli_escape_string($db,$_POST['name']);
    $email = mysqli_escape_string($db,$_POST['email']);
    $password = $_POST['password'];



    // Server-side validation

    $errors = [];
    if ($name == ''){
        $errors ['name'] = 'Please fill in your name.';
    }
    if ($email == ''){
        $errors ['email'] = 'Please fill in your name.';
    }
    if ($password == ''){
        $errors  ['password'] = 'Please fill in your password.';
    }



    // If data valid
    if (empty($errors)){

        // ik pak alles van de tabel Users en ik wil alleen de kollommen, waarbij email gelijk is aan $email
        // email is de postwaarde = $email
        $query = "SELECT * FROM users WHERE email = '$email' ";

        //mysqli = een functie. de functie heeft nodig de Database connection & Query.
        //deze geeft terug door magische code in mysqli_result of Bool
        // Boolean = TRUE OR FALSE
        $result = mysqli_query($db, $query);



        //Check als er HETZELFDE email in de database zit of niet.
        if (mysqli_num_rows($result) == 0) {
            $password = password_hash($password,PASSWORD_DEFAULT);

            // store the new user in the database.
            $query = "INSERT INTO users (name, email,password) 
                  VALUES ('$name','$email', '$password')";


            $result = mysqli_query($db, $query);

            // If query succeeded
            if ($result){

                // Redirect to login page
                header('Location: login.php');
                exit;
            }


        }else{
                $errors['register'] = 'This user already exist.';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Registreren</title>
</head>
<body>

<!-- Register -->


<div class="section no-bottom-margin">
    <div class="container">
        <div class="box m-6 is-orange is-rounded-soft">
            <form action="" method="post">
                <h1 class="title is-1 has-text-centered">Registeren</h1>
                <div class="field m-6">
                    <label class="label" for="name">Naam</label>
                    <div class="control has-icons-left ">
                        <input class="input is-info" type="text" name="name" placeholder="Naam" value="<?= $name ?? '' ?>" id="name">
                        <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                    </div>
                    <p class="help is-danger"><?php if (isset($errors['name'])){
                        echo $errors['name'];
                        } ?></p>

                </div>

                <div class="field m-6">
                    <label class="label" for="name">email</label>
                    <div class="control has-icons-left">
                        <input class="input is-info" type="text" name="email" placeholder="email" value="<?= $email ?? '' ?>" id="email">
                        <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                    </div>
                    <p class="help is-danger"><?php if (isset($errors['email'])){
                            echo $errors['email'];
                        } ?></p>

                    <p class="help is-danger"><?php if (isset($errors['register'])){
                        echo $errors['register'];
                        } ?></p>

                </div>

                <div class="field m-6">
                    <label class="label" for="password">Wachtwoord</label>
                    <div class="control has-icons-left">
                        <input class="input is-info" type="password" name="password" placeholder="Wachtwoord" value="" id="password">
                        <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                    </div>
                    <p class="help is-danger"><?php if (isset($errors['password'])){
                            echo $errors['password'];
                        } ?></p>
                </div>
                <div class="field m-6">
                    <div class="control">
                        <input type="submit" name="submit" value="Sturen" class="button is-link">
                    </div>
                </div>
                <a class="button mt-4" href="login.php">&laquo; Al een account ga naar login</a>
            </form>
        </div>
    </div>
</div>`



</body>
</html>
