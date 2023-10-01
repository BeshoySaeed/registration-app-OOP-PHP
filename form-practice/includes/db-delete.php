<?php

if (!$_SESSION['email']) {
    header("location: ../login.php");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];

try {
    //OOP
    require_once("../../db-oop.php");
    $conn = new DB("localhost", "students_data", "phpmyadmin", "224466");
    $conn->delete_from_db("students", "id = $id");

    header("location: db-views.php");
} catch (PDOException $e) {
    echo "error caused when try to delete " . $e->getMessage();
}
