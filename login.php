<?php
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/header_dev.php';
include('auth/secure_login.php');
$errors["401"] = "wrong user credentials";
$errors["418"] = "I'm a teapot.";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <main>
        <?php
        if (isset($_GET["error"])) {
            print($errors["401"]);
        }
        ?>
        <form method="post" action="auth/auth.php">
            <label for="uname">Username</label><br>
            <input type="text" id="email" name="email" placeholder="your email" required><br>
            <label for="pwd">Password</label><br>
            <input type="password" id="pwd" name="pwd" placeholder="your password" required><br><br>
            <input type="submit" value="login">
        </form>

    </main>
</body>

</html>