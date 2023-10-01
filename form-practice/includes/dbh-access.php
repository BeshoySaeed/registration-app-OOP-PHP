<?php

// catch data from register form

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $skill = validate($_POST['skills']);
    $pass = validate($_POST['pass']);
    $cpass = validate($_POST['cpass']);
    $submitBtn = validate($_POST['btn']);
    $img = $_FILES['img'];
    $arrayOfErrors = [];


    //empty check 

    if (empty($fname)) {
        $arrayOfErrors['empty_fname'] = 'what is your first name';
    }
    if (empty($lname)) {
        $arrayOfErrors['empty_lname'] = 'what is your last name';
    }
    if (empty($email)) {
        $arrayOfErrors['empty_email'] = 'what is your email';
    }
    if (empty($phone)) {
        $arrayOfErrors['empty_phone'] = 'what is your phone number';
    }
    if (empty($pass)) {
        $arrayOfErrors['empty_pass'] = 'what is your password';
    }
    if (empty($cpass)) {
        $arrayOfErrors['empty_cpass'] = 'please confirm your password';
    }

    // validate length

    if (strlen($fname) < 2 || strlen($lname) < 2) {
        $arrayOfErrors['len_name'] = "minimum length 2 character";
    }

    // validate pattern check 

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $arrayOfErrors['valid_email'] = "not valid email";
    }

    // check confirm password 

    if ($pass !== $cpass) {
        $arrayOfErrors['not_equal'] = 'confirm password and password not equal';
    }

    if (count($arrayOfErrors) > 0) {
        session_start();
        $_SESSION['errors'] = $arrayOfErrors;
        header("location: ../register.php");
    } else {
        // if there is not error

        require_once("../../db-oop.php");
        if ($submitBtn == 'submit') {
            move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/' . $_FILES['img']["name"]);
            $data = [
                "fname" => $fname,
                "lname" => $lname,
                "email" => $email,
                "phone" => $phone,
                "pass"  => $pass,
                "img"   => $img['name']
            ];
            $conn = new DB("localhost", "students_data", "phpmyadmin", "224466");
            $conn->insert_into_db('students', $data);
            header("location: ../login.php");
        } elseif ($submitBtn == 'update') {
            $id = $_POST['id'];
            try {
                $conn = new DB("localhost", "students_data", "phpmyadmin", "224466");
                $conn->update_from_db("students", "id = $id", $fname, $lname, $email, $phone, $pass);

                header("location: db-views.php");
            } catch (PDOException $e) {
                echo "error " . $e->getMessage();
            }
        }
    }
}
function validate($input)
{
    $validateInput = trim($input);
    $validateInput = stripslashes($input);
    $validateInput = htmlspecialchars($validateInput);
    return $validateInput;
}
