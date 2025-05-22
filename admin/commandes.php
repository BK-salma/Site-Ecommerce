<?php
session_start();
require_once '../includes/db.php';

if(!isset($_SESSION['user_id'])||$_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['commande_id'], $_POST['statut'])) {
    $id=$_POST['commande_id'];
    $statut=mysqli_real_escape_string($conn, $_POST['statut']);
    mysqli_query($conn,"UPDATE commandes SET statut = '$statut' WHERE id = $id");
}


$query = "
    SELECT c.*, u.nom AS client
    FROM commandes c
    JOIN users u ON c.user_id = u.id
    ORDER BY c.date_commande DESC
";
$commandes = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commandes</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <h1>Liste des commandes</h1>
    <p><a href="index.php">Retour</a></p>

    <br>
    <?php while($cmd=mysqli_fetch_assoc($commandes)): ?>
      <div style="border:1px solid #ccc; padding:15px; margin-bottom:20px;">
           
          <h3>Commande #<?= $cmd['id'] ?> — Client: <?= htmlspecialchars($cmd['client']) ?></h3>
            
            <p><strong>Date:</strong> <?= $cmd['date_commande'] ?></p>
            <p><strong>Paiement:</strong> <?= $cmd['mode_paiement'] ?></p>
            <p><strong>Statut:</strong> 
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="commande_id" value="<?=$cmd['id'] ?>">

                    <select name="statut">
                        <option<?=$cmd['statut']==='en cours' ?' selected' :''?> value="en cours">--En cours--</option>
                        <option<?=$cmd['statut']==='livrée' ?' selected' :''?> value="livrée">Livrée</option>
                        <option<?=$cmd['statut']==='annulée' ?' selected' :''?> value="annulée"> Annulée</option>
                    </select>
                </form>
            </p>

            <table border="1" cellpadding="5" cellspacing="0" width="100%">
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>

    <?php
        $details=mysqli_query($conn,"SELECT d.*, p.nom 
                                       FROM details_commande d
                                       JOIN produits p ON d.produit_id=p.id
                                       WHERE d.cmd_id={$cmd['id']}");
        $total = 0;
        
        while($item=mysqli_fetch_assoc($details)):
            $sous_total=$item['quantite']*$item['prix_unitaire'];
            $total +=$sous_total;
    ?>
                    <tr>
                        <td><?=htmlspecialchars($item['nom']) ?></td>
                        <td><?=$item['quantite'] ?></td>
                        <td><?=$item['prix_unitaire']?> DH</td>
                        <td><?=$sous_total ?> DH</td>
                    </tr>
                <?php endwhile; ?>

                <tr>
                    <td colspan="3" align="right"><strong>Total commande :</strong></td>
                    <td><strong><?=$total?> DH</strong></td>
                </tr>
            </table>
        </div>
    <?php endwhile; ?>
</body>
</html>