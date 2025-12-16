<?php

// $host="localhost";
// $user="root";
// $pass="";
// $db="agapi";

// $conn = new mysqli($host,$user,$pass,$db);

// if($conn->connect_error){
//     die("Connection error: ".$conn->connect_error);
// };


$dsn = 'mysql:host=localhost;dbname=agapi';
$user = "root";
$pass = "";

try {
    $conn = new PDO($dsn,$user,$pass);
    $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Error: " . $e->getMessage();
}
