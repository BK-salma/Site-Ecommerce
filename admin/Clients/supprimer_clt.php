<?php
session_start();
require_once '../../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../login.php');
    exit;
}

if(!isset($_GET['id'])){
    header('Location: ../clients.php');
    exit;
}

$id =$_GET['id'];

$res=mysqli_query($conn, "SELECT * FROM users 
                           WHERE id = $id  and role='client'");

if($res){
 mysqli_query($conn, "DELETE FROM users WHERE id = $id");
}

header('Location: ../clients.php');
exit;   

?>
