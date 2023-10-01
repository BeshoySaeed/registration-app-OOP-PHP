<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$email = $_POST['email'];
$pass = $_POST['pass'];

// echo "hello";
echo $email . " " . $pass . "<br>";


try {
        
    require_once("db.inc.php");
    
    $query = "SELECT * FROM students WHERE email = ? AND pass = ? ";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email, $pass]);

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
     print_r($data); 

    if($data){
        session_start();
        unset($_SESSION['login_error']);
        $_SESSION['email'] = $email;
        header("location: db-views.php");

    }else{
        session_start();
        $_SESSION['login_error'] = 'email or password not valid try later';
        header("location: ../login.php");
        echo "error";
    }

} catch (PDOException $e) {
    echo "wrong user ".$e->getMessage();
}