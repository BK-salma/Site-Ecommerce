<?php
session_start();
require_once 'includes/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'client') {
    header('Location: login.php?');
    exit;
}

$user_id=$_SESSION['user_id'];
$message='';

//select les produits se trouvent dans le panier d'un user:
$query=" SELECT p.id,p.nom,p.prix,c.quantite
          FROM panier c
          JOIN produits p 
          ON c.produit_id=p.id
          WHERE c.user_id=$user_id";

$result = mysqli_query($conn,$query);
$panier = mysqli_fetch_all($result,MYSQLI_ASSOC);

if(count($panier)===0){
    header('Location: panier.php');
    exit;
}

if($_SERVER['REQUEST_METHOD']==='POST') {
    $payer=mysqli_real_escape_string($conn,$_POST['mode_paiement']);

    $insere_cmd="INSERT INTO commandes(user_id,mode_paiement) 
                 VALUES($user_id,'$payer')";
    mysqli_query($conn,$insere_cmd);
    $cmd_id=mysqli_insert_id($conn);

    foreach($panier as $art){
        $produit_id=$art['id'];
        $prix=$art['prix'];
        $quantite=$art['quantite'];

        mysqli_query($conn,"INSERT INTO details_commande(cmd_id,produit_id,quantite,prix_unitaire)
                             VALUES($cmd_id,$produit_id,$quantite,$prix)");
    }

    mysqli_query($conn,"DELETE FROM panier WHERE user_id=$user_id");
    $message="Commande passes avec succès";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Valider la commande</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require_once 'header.php' ?>
    <h1>Confirmation de la commande</h1>

    <?php if($message): ?>
        <p style="color:green"><?= htmlspecialchars($message) ?></p>
        <p><a href="index.php">Voir plus de produits</a></p>
        <?php exit; ?>
    <?php endif; ?>

    <h3>Resume de votre panier :</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach ($panier as $item): ?>
            <?php $sous_total=$item['prix']*$item['quantite']; ?>
            <tr>
                <td><?= htmlspecialchars($item['nom']) ?></td>
                <td><?= number_format($item['prix'], 2) ?> DH</td>
                <td><?= $item['quantite'] ?></td>
                <td><?= number_format($sous_total, 2) ?> DH</td>
            </tr>
            <?php $total+=$sous_total; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" align="right"><strong>Total :</strong></td>
            <td><strong><?= number_format($total, 2) ?> DH</strong></td>
        </tr>
    </table>

    <br>
    <form method="POST">
        <label for="mode_paiement">Mode de paiement :</label><br>
        <select name="mode_paiement" required>
            <option value="">-- Choisir --</option>
            <option value="carte bancaire">Carte bancaire</option>
            <option value="à la livraison">Paiement à la livraison</option>
        </select><br><br>
        
        <a href="commande.php"><button>Confirmer la commande</button></a>
         

    </form>

</body>
</html>
