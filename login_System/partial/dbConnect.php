<?php
//initializing credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "users00";

//connecting to database
mysqli_report(MYSQLI_REPORT_OFF); //this stops error printing

// $conn = mysqli_connect($servername, $username, $password); ->if not want to connect the database
$conn = @mysqli_connect($servername, $username, $password, $database); //if want to connect database too
//@ also supress error print
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error() . "<br>";
} 
?>