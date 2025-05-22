<?php
session_start();
require_once '../includes/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
h1 a {
    color:rgb(142, 71, 109);
    font-size: 1rem;
    margin-left: 18px;
    text-decoration: none;
    font-weight: normal;
    transition: color 0.2s;
}

h1 a:hover {
    color: #fff;
    text-decoration: underline;
}

ul {
    list-style: none;
    padding: 0;
    max-width: 350px;
    margin: 40px auto;
}

ul li {
    margin-bottom: 18px;
}

ul li a {
    display: block;
    background: #fff;
    color:rgb(39, 2, 34);
    text-decoration: none;
    padding: 16px 0;
    border-radius: 8px;
    font-size: 1.15rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(44,62,80,0.08);
    font-weight: 500;
    transition: background 0.2s, color 0.2s;
}

ul li a:hover {
    background:rgb(65, 10, 46);
    color: #fff;
}
    </style>

</head>
<body>

    <h1>Bienvenue,<?=htmlspecialchars($_SESSION['nom']) ?> </h1>

    <p style="text-align: center; color: #6a016c; font-size: 2rem; font-family:cursive;">
    Gérez facilement vos produits, clients et commandes depuis cet espace d’administration.
</p>
   <br> 
    <ul>
        <li><a href="produits.php">Gérer les produits</a></li>
        <li><a href="clients.php">Gérer les clients</a></li>
        <li><a href="commandes.php">Gérer les commandes</a></li>
        <li><a href="../logout.php">Déconnexion</p></li>
    </ul>
</body>
</html>
