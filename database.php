<?php
$hostName = "sql7.freesqldatabase.com";
$dbUser = "sql7621939";
$dbPassword = "TZyXjTH7cb";
$dbName = "sql7621939";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if(!$conn){
    die("Something went wrong!!!!");
} 
?>