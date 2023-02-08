<?php
session_start();

$login = false;
// Is user logged in?


if (isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "databaseQuery.php";


    // Get form data
    $email = mysqli_escape_string($db,$_POST['email']);
    $password = $_POST['password'];

    // Server-side validation
    $errors = [];
    if ($email == ''){
        $errors ['email'] = 'Please fill in your email.';

    }
    if ($password == ''){
        $errors  ['password'] = 'Please fill in your password.';
    }


    // If data valid
    if (empty($errors)){

        // SELECT the user from the database, based on the email address.
        $query = "SELECT * FROM `users`WHERE email= '$email'";
        $result = mysqli_query($db, $query);


        // check if the user exists
        if (mysqli_num_rows($result) == 1) {
            // Get user data from result
            $user = mysqli_fetch_assoc($result);
            // Check if the provided password matches the stored password in the database
            if (password_verify($password, $user['password'])) {
                // Store the user in the session
                $_SESSION['loggedInUser'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'admin' => $user['admin']
                ];
                // Redirect to secure page
                header('Location: index.php');
                exit;
                //error incorrect log in
            } else {
                $errors['LoginFailed'] = 'The provided credentials do not match.';
            }
            //error incorrect log in
        }else{
            $errors['loginFailed'] = 'The provided credentials do not match.';
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
    <title>Log in</title>
</head>
<body>



<!-- Login-->

<div class="section no-bottom-margin">
    <div class="container">
        <div class="box m-6 is-orange is-rounded-soft">
            <form action="" method="post">
                <h1 class="title is-1 has-text-centered">Login</h1>

                <div class="field m-6">
                    <label class="label" for="email">Email</label>
                    <div class="control has-icons-left ">
                        <input class="input is-info" type="email" name="email" placeholder="Email" value="<?= $email ?? '' ?>" id="email">
                        <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                    </div>
                    <p class="help is-danger"><?php if (isset($errors['email'])){
                            echo $errors['email'];
                        } ?></p>
                </div>



                <div class="field m-6">
                    <label class="label" for="password">Wachtwoord</label>
                    <div class="control has-icons-left ">
                        <input class="input is-info" type="password" name="password" placeholder="Wachtwoord" value="<?= $password ?? '' ?>" id="password">
                        <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                    </div>
                    <p class="help is-danger">
                        <?php if (isset($errors['password'])){
                            echo $errors['password'];
                        } ?></p>
                </div>
                <div class="field m-6">
                    <div class="control">
                        <input type="submit" name="submit" value="Sturen" class="button is-link">
                    </div>
                </div>
                <a class="button mt-4" href="register.php">&laquo; Nog geen account maak nu een account aan</a>
            </form>
        </div>
    </div>
</div>`


</body>
</html>


