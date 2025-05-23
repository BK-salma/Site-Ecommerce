<?php
session_start();
require_once 'includes/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role']!=='client') {
    header('Location: login.php');
    exit;
}

if($_SERVER['REQUEST_METHOD']==='POST') {
  if(isset($_POST['produit_id'], $_POST['quantite'])){

    $user_id= $_SESSION['user_id'];
    $produit_id=$_POST['produit_id'];
    $quantite=max(1,$_POST['quantite']);

    $check_prod = mysqli_query($conn,"SELECT id FROM produits 
                                      WHERE id=$produit_id ");
                                      
    if(mysqli_num_rows($check_prod)=== 0) {
        header('Location: index.php?');
        exit;
    }

    // verifier produit dans le panier ou non
    $check_panier=mysqli_query($conn,"SELECT id,quantite 
                                      FROM panier 
                                      WHERE user_id=$user_id AND produit_id=$produit_id");

    if(mysqli_num_rows($check_panier)>0) {
     // produit existe alors:
        $row=mysqli_fetch_assoc($check_panier);
        $new_qt=$row['quantite']+$quantite;
        mysqli_query($conn,"UPDATE panier 
                            SET quantite=$new_qt 
                            WHERE id={$row['id']}");
    
    }else{
        mysqli_query($conn,"INSERT INTO panier(user_id,produit_id,quantite) 
                             VALUES($user_id,$produit_id,$quantite)");
    }
    header('Location: panier.php');
    exit;

  }else{
    header('Location: index.php');
    exit;
    }
}
