<?php
session_start();
require_once '../../includes/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../login.php');
    exit;
}

if(!isset($_GET['id'])) {
    header('Location: ../produits.php');
    exit;
}

$id =$_GET['id'];

//recupere image 
$result = mysqli_query($conn, "SELECT image FROM produits WHERE id = $id");
$produit = mysqli_fetch_assoc($result);

//suppr image dans dossier uploads
if ($produit && !empty($produit['image'])) {
    $chemin_img = '../../uploads/produits/' . $produit['image'];
    if (file_exists($chemin_img)) {
        unlink($chemin_img); 
    }
}

//suppr depuis data base
mysqli_query($conn, "DELETE FROM produits WHERE id = $id");

header('Location: ../produits.php');
exit;
?>
