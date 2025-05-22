<?php
session_start();
require_once '../../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../login.php');
    exit;
}

$message = '';

$res_categ= mysqli_query($conn, "SELECT * FROM categories");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //definir les variables utilises 
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $prix =(float) $_POST['prix'];
    $stock =(int) $_POST['stock'];
    $categorie_id =(int) $_POST['categorie_id'];
    $image_name = '';

    
    if(!empty($_FILES['image']['name'])) {

        $image_name = basename($_FILES['image']['name']);
        $chemin_direct= "../../uploads/produits/";
        $chemin_fichier= $chemin_direct . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $chemin_fichier);
    }

    $query="INSERT INTO produits(nom, description, prix, stock, categorie_id, image) 
            VALUES('$nom','$description', $prix, $stock, $categorie_id, '$image_name')";
    
    if(mysqli_query($conn, $query)) {
        $message = "Produit ajouté avec succès.";
    } else {
        $message = "Erreur lors de l'ajout du produit.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <h1>Ajouter un nouveau produit</h1>
    <p><a href="../produits.php">Retour à la liste des produits</a></p>

    <?php if($message): ?>
        <p style="color: green;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Nom :</label><br>
        <input type="text" name="nom" required><br><br>

        <label>Description :</label><br>
        <textarea name="description" required></textarea><br><br>

        <label>Prix :</label><br>
        <input type="number" step="0.01" name="prix" required><br><br>

        <label>Stock :</label><br>
        <input type="number" name="stock" required><br><br>

        <label>Catégorie :</label><br>
        <select name="categorie_id" required>
            <option value="">-- Choisir une catégorie --</option>
            
            <?php while ($cat = mysqli_fetch_assoc($res_categ)): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
            <?php endwhile; ?>

        </select><br><br>

        <label>Image :</label><br>
        <input type="file" name="image"><br><br>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
