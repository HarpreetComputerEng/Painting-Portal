<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    // Log user logout
    $uip = $_SERVER['REMOTE_ADDR'];
    $status = 0;
    $log = "INSERT INTO userlog(userEmail,userip,status) VALUES('".$_SESSION['login']."','$uip','$status')";
    $result = mysqli_query($con, $log);
    
    session_destroy();
    header('location:index.php');
}
?>