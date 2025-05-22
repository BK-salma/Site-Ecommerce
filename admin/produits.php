<?php
session_start();
require_once('../includes/db.php');

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$query="SELECT p.*, c.nom AS categorie 
        FROM produits p 
        LEFT JOIN categories c 
        ON p.categorie_id = c.id";

$result =mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les produits</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Gestion des produits</h1>
    <p><a href="index.php">Retour</a></p>
    <p><a href="Prods/ajouter_prod.php">Ajouter un produit</a></p>
<br>
    <table border="1" cellpadding="10" cellspacing="0" ">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Catégorie</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>

        <?php while ($produit = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?=$produit['id'] ?></td>
                <td><?=htmlspecialchars($produit['nom'])?></td>
                <td><?=htmlspecialchars($produit['categorie']) ?></td>
                <td><?=$produit['prix'] ?> DH</td>
                <td><?=$produit['stock'] ?></td>
                <td>
                    <?php if(!empty($produit['image'])): ?>
                        <img src="../uploads/produits/<?= $produit['image']?>" width="50">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="Prods/mod_prod.php?id=<?= $produit['id'] ?>">Modifier</a> <br>
                    <a href="Prods/supp_prod.php ?id=<?= $produit['id'] ?>"
                        onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>