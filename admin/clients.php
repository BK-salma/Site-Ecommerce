<?php
session_start();
require_once '../includes/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$q= "SELECT * FROM users 
     ORDER BY role DESC, nom ASC";

$result=mysqli_query($conn,$q);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des clients</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Gestion des utilisateurs</h1>
    <p><a href="index.php">Retour </a></p>
    <br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>---</th>
        </tr>

        <?php while($user=mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['nom']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <?php if($user['role']!=='admin'): ?>
                        <a href="Clients/supprimer_clt.php? id= <?= $user['id'] ?>" 
                        onclick="return confirm('Confirmer la suppression ?')"> Supprimer</a>

                        <a href="Clients/modifier_clt.php? id= <?= $user['id'] ?> "> Modifier </a>
                    <?php else: ?>
                        IMPOSSIPLE DE MODIFIER 
                    <?php endif; ?>
                </td>
            </tr>

        <?php endwhile; ?>
    </table>
</body>
</html>
