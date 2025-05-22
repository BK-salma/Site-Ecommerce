<?php
$host = 'localhost';
$dbname = 'ecommerce';  
$user = 'root';         
$pass = '';       

$conn =mysqli_connect($host, $user, $pass, $dbname);
   if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
   }
?>
