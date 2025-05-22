<?php
session_start();
require_once 'includes/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'client') {
    header('Location: login.php');
    exit;
}

$user_id=$_SESSION['user_id'];

$cmds=mysqli_query($conn,"SELECT * FROM commandes 
                          WHERE user_id=$user_id 
                          ORDER BY date_commande DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes commandes</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require_once 'header.php' ?>
    <h1>Mes commandes</h1>

    <?php if (mysqli_num_rows($cmds) === 0): ?>
        <p>Vous n'avez encore passé aucune commande.</p>
    <?php else: ?>
        <?php while ($cmd = mysqli_fetch_assoc($cmds)): ?>
            <div style="border:1px solid #ccc; padding:15px; margin-bottom:20px;">
                <h3>Commande #<?= $cmd['id'] ?> — <?= $cmd['date_commande'] ?></h3>
                
                <p><strong>Statut:</strong> <?= htmlspecialchars($cmd['statut']) ?></p>
                <p><strong>Paiement:</strong> <?= htmlspecialchars($cmd['mode_paiement']) ?></p>

                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tr>
                        <th>Produit</th>
                        <!-- <th>Image</th> -->
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>

    <?php
        $details = mysqli_query($conn,"SELECT d.*,p.nom
                                        FROM details_commande d
                                        JOIN produits p ON d.produit_id = p.id
                                        WHERE d.cmd_id ={$cmd['id']}
                    ");
        $total = 0;
        while($item = mysqli_fetch_assoc($details)):
                $sous_total = $item['quantite']*$item['prix_unitaire'];
                $total += $sous_total;
    ?>
                    <tr>
                            <td><?= htmlspecialchars($item['nom'])?></td>
                            <td><?= $item['quantite'] ?></td>
                            <td><?= $item['prix_unitaire']?> DH</td>
                            <td><?= $sous_total ?> DH</td>
                        </tr>
                    <?php endwhile; ?>

                    <tr>
                        <td colspan="3" align="right"><strong>Total commande :</strong></td>
                        <td><strong><?=$total?> DH</strong></td>
                    </tr>
                </table>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</body>
</html>
