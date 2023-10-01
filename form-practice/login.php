<?php
session_start();
if ($_SESSION['login_error']) {
    $error = $_SESSION['login_error'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./register.css">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <form action="./includes/db-login.php" method="post">
            <p>Login form</p>
            <label for="email">email</label>
            <input type="text" id="email" name="email">
            <label for="pass">password</label>
            <input type="password" id="pass" name="pass">
            <input type="submit" value="login" class="submit" name="btn">
            <p style="color: red; margin-top: -10px; margin-bottom: 20px;"> <?= $error ?> </p>
            <a href="register.php">Don't have an account</a>
        </form>
    </div>
</body>

</html>