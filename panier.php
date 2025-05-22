<?php
session_start();
require_once 'includes/db.php';

if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id=$_SESSION['user_id'];
$message='';

if($_SERVER['REQUEST_METHOD']==='POST') {
    if(isset($_POST['update'])) {
        $qts=$_POST['quantite'];
        foreach($qts as $produit_id => $qty) {
            $qty=(int)$qty;
            if($qty>0) {
                mysqli_query($conn,"UPDATE panier SET quantite=$qty WHERE user_id=$user_id AND produit_id=$produit_id");
            }else{
                mysqli_query($conn,"DELETE FROM panier WHERE user_id=$user_id AND produit_id=$produit_id");
            }
        }
        $message="Panier mis à jour.";
    }
}

$query= "SELECT p.id, p.nom, p.prix, p.image, c.quantite 
          FROM panier c
          JOIN produits p ON c.produit_id=p.id
          WHERE c.user_id=$user_id";

$result=mysqli_query($conn,$query);
$produits=mysqli_fetch_all($result,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require_once 'header.php' ?>
    
    <h1>Mon Panier</h1>

    <?php if ($message): ?>
        <p style="color:green"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if (count($produits) > 0): ?>
        <form method="POST">
            <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>Produit</th>
                    <th>Image</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>                 
                </tr>

                <?php $total = 0; ?>
                <?php foreach($produits as $produit): ?>
                    <?php $sous_total=$produit['prix']*$produit['quantite']; ?>
                    <tr>
                        <td><?=htmlspecialchars($produit['nom']) ?></td>
                        <td>
                            <?php if($produit['image']): ?>
                                <img src="uploads/produits/<?= $produit['image'] ?>" width="50">
                            <?php endif; ?>
                        </td>
                        <td><?=$produit['prix']?> DH</td>
                        <td>
                            <input type="number" name="quantite[<?= $produit['id'] ?>]" value="<?= $produit['quantite'] ?>" min="0">
                        </td>
                        <td><?= $sous_total?>DH</td>
                    </tr>
                    <?php $total+=$sous_total; ?>
                <?php endforeach; ?>

                <tr>
                    <td colspan="4" align="right"><strong>Total :</strong></td>
                    <td><strong><?=$total?> DH</strong></td>
                </tr>
            </table>

            <br>
            <!-- la modification: -->
            <button type="submit" name="update">Mettre à jour le panier</button>
            <br>
        </form>

        <a href="commande.php"> <button >Passer la commande</button></a> 


    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>
</body>
</html>
