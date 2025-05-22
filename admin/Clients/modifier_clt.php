<?php
session_start();
require_once '../../includes/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: ../clients.php');
    exit;
}

$id =$_GET['id'];
$message = '';

$result= mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
$user= mysqli_fetch_assoc($result);

if(!$user){
    header('Location: ../clients.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom= $_POST['nom'];
    $email= $_POST['email'];

    $modif = "UPDATE users SET nom='$nom', email='$email' WHERE id=$id";

    if (mysqli_query($conn, $modif)) {
        $message = "Utilisateur modifié avec succès.";
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $id"));
    } else {
        $message = "Erreur lors de la modification.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <h1>Modifier un utilisateur</h1>
    <p><a href="../clients.php">Retour à la liste des clients</a></p>

    <?php if ($message): ?>
        <p style="color: green;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST">
        Nom :<br>
        <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required><br><br>

        Email :<br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
