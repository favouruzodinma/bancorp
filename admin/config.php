<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "bancorp";

//$conn = new mysqli ( $host, $user, $pass , $dbname )
$conn = new mysqli ("localhost", "root", "", "bancorp");

function cleaninput($data){
    GLOBAL $conn;
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlentities($data);
    $data = $conn->real_escape_string($data);
    return $data;
}

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

