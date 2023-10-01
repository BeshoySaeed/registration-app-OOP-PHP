<?php
// session_start();
// if(!$_SESSION['email']){
//     header("location: ../register.html");
// }

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<table border="1">

    <tr>
        <th>id</th>
        <th>first name</th>
        <th>last name</th>
        <th>email</th>
        <th>phone</th>
        <th>password</th>
        <th>img</th>
        <th>controls</th>
    </tr>

    <?php

    try {
        require_once('../../db-oop.php');
        $conn = new DB("localhost", "students_data", "phpmyadmin", "224466");
        $data = $conn->get_from_db("students");

        foreach ($data as $key => $value) {
            echo "<tr>";
            foreach ($value as $k => $v) {
                if ($k == 'img') {
                    echo "<td><img src='./uploads/{$value['img']}' width='40px'> </td>";
                } else {

                    echo "<td> $v </td>";
                }
            }
            echo "<td> <a href='../edit-page.php?id={$value['id']}' > Edit </a> <a href='db-delete.php?id={$value['id']}' >Delete</a> </td>";
            echo "</tr>";
        }
    } catch (PDOException $e) {
        echo "data failed " . $e->getMessage();
    }
    ?>

</table>