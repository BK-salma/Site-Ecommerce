<?php
session_start();
require_once '../../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: ../produits.php');
    exit;
}


$id =$_GET['id'];
$message='';

$result = mysqli_query($conn, "SELECT * FROM produits WHERE id = $id");
$produit = mysqli_fetch_assoc($result);

$categories= mysqli_query($conn, "SELECT * FROM categories");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $prix =$_POST['prix'];
    $stock = $_POST['stock'];
    $categorie_id =$_POST['categorie_id'];
    $image_name = $produit['image']; 
    
    //verifier si l'image existe 
    if(!empty($_FILES['image']['name'])){
        $image_name= basename($_FILES['image']['name']);
        $chemin_direct= "../../uploads/produits/";
        $chemin_fichier= $chemin_direct . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $chemin_fichier);
    }

    $modifier = "UPDATE produits
                 SET nom='$nom', description='$description', prix=$prix, stock=$stock, 
                     categorie_id=$categorie_id, image='$image_name' 
                 WHERE id='$id'";
    
    if(Mysqli_query($conn, $modifier)){
        $message="Produit modifié avec succès";
        header("Location: ../produits.php");
    }else{
        $message= "Erreur lors de la modification du produit";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier produit</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <h1>Modifier un produit</h1>
    <p><a href="../produits.php">Retour à la liste</a></p>

    <?php if ($message): ?>
        <p style="color:green"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Nom :</label><br>
        <input type="text" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>" required><br><br>

        <label>Description :</label><br>
        <textarea name="description" required><?= htmlspecialchars($produit['description']) ?></textarea><br><br>

        <label>Prix :</label><br>
        <input type="number" step="0.01" name="prix" value="<?= $produit['prix'] ?>" required><br><br>

        <label>Stock :</label><br>
        <input type="number" name="stock" value="<?= $produit['stock'] ?>" required><br><br>

        <label>Catégorie :</label><br>
        <select name="categorie_id" required>
            <?php while ($cat = mysqli_fetch_assoc($categories)): ?>
                <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $produit['categorie_id']) ? 'selected' : '' ?> >
                    <?= htmlspecialchars($cat['nom']) ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Changer l'image :</label><br>
        <label>Image actuelle:</label><br>
        <?php if (!empty($produit['image'])): ?>
            <img src="../../uploads/produits/<?= $produit['image'] ?>" width="100"><br>
        <?php endif; ?>
        <input type="file" name="image"><br><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
