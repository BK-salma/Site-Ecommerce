<?php
session_start();
require_once 'includes/db.php';

//verifier id d'entrer
if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id=$_GET['id'];


$query = " SELECT p.*, c.nom AS categorie 
           FROM produits p 
           LEFT JOIN categories c ON p.categorie_id = c.id
           WHERE p.id = $id
           LIMIT 1
";
$result = mysqli_query($conn, $query);
$produit = mysqli_fetch_assoc($result);

if (!$produit) {
    echo "<p>Produit introuvable.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($produit['nom']) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php require_once 'header.php' ?>

    <div style="border:1px solid #ccc; padding:20px; max-width:600px;">
        <h2><?= htmlspecialchars($produit['nom']) ?></h2>
        <p><strong>Catégorie:</strong> <?= htmlspecialchars($produit['categorie']) ?></p>
        <p><strong>Prix:</strong> <?= number_format($produit['prix'], 2) ?> DH</p>
        
        <?php if (!empty($produit['image'])): ?>
            <img src="uploads/produits/<?= htmlspecialchars($produit['image']) ?>" 
            alt="<?= htmlspecialchars($produit['nom']) ?>" 
            style="max-width:300px;">
            
        <?php endif; ?>

        <p><strong>Description:</strong><br>
            <?= htmlspecialchars($produit['description']) ?>
        </p>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'client'): ?>
            <form method="POST" action="ajouter_panier.php">
                <input type="hidden" name="produit_id" value="<?= $produit['id'] ?>">
                <label>Quantité:</label>
                <input type="number" name="quantite" value="1" min="1" style="width:50px">
                <button type="submit">Ajouter au panier</button>
            </form>
        <?php else: ?>
            <p><a href="login.php">Connectez-vous pour acheter ce produit</a></p>
        <?php endif; ?>
    </div>

</body>
</html>
