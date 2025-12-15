<?php

$host="localhost";
$user="root";
$pass="";
$db="agapi";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    die("Connection error: ".$conn->connect_error);
};
