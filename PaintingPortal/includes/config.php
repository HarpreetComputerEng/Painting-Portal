<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "paintingportal";

// Use mysqli for consistency with existing code
$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// PDO version for backward compatibility
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
}
catch(PDOException $e) {
    echo "Connection failed:  " . $e->getMessage();
}
?>