<?php

session_start();
if (!$_SESSION['email']) {
    header("location: login.php");
}

if ($_SESSION['errors']) {
    $errors = $_SESSION['errors'];

    if ($errors['empty_phone']) {
        $emtyPhone = $errors['empty_phone'];
    }
    if ($errors['empty_pass']) {
        $emtyPass = $errors['empty_pass'];
    }
    if ($errors['empty_cpass']) {
        $emtyCPass = $errors['empty_cpass'];
    }
    if ($errors['len_name']) {
        $len_name = "minimum length 2 character";
    }

    if ($errors['valid_email']) {
        $valid_email = "not valid email";
    }
    if ($errors['not_equal']) {
        $notEqual = 'confirm password and password not equal';
    }
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
        <form action="./includes/dbh-access.php" method="post" enctype="multipart/form-data">
            <p>Register form</p>
            <label for="fname">first name</label>
            <input type="text" id="fname" name="fname">
            <p style="color: red; margin-bottom: 10px;"> <?= $len_name ?> </p>

            <label for="lname">last name</label>
            <input type="text" id="lname" name="lname">
            <p style="color: red;margin-bottom: 10px;"> <?= $len_name ?> </p>

            <label for="email">email</label>
            <input type="text" id="email" name="email">
            <p style="color: red;margin-bottom: 10px;"> <?= $valid_email ?> </p>


            <label for="phone">phone</label>
            <input type="tel" id="phone" name="phone">
            <p style="color: red; margin-bottom: 10px;"> <?= $emtyPhone ?> </p>

            <label>skills</label>
            <select name="skills">
                <option value="js">Js</option>
                <option value="css">Css</option>
                <option value="html">HTML</option>
                <option value="db">database</option>
                <option value="php">PHP</option>
                <option value="lar">larvel</option>
            </select>
            <label for="pass">password</label>
            <input type="password" id="pass" name="pass">
            <p style="color: red; margin-bottom: 10px;"> <?= $emtyPass ?> </p>

            <label for="cpass">confirm password</label>
            <input type="password" id="cpass" name="cpass">
            <p style="color: red; margin-bottom: 10px;"> <?= $notEqual ?> </p>

            <input type="file" name="img" id="">
            <input type="submit" value="submit" class="submit" name="btn">
            <a href="login.php">already have an account</a>
        </form>
    </div>
</body>

</html>