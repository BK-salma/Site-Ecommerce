<?php
session_start();
require_once 'includes/db.php'; 

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email =$_POST['email'];
    $password =$_POST['password'];

    if (!empty($email) && !empty($password)) {
        $query= "SELECT * FROM users WHERE email = '$email'";
        $result =mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $user= mysqli_fetch_assoc($result);
            
            if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nom'] = $user['nom'];

            if ($user['role'] ==='admin') {
                header('Location: admin/index.php');
            } else {
                header('Location: index.php');
            }
            exit;
        } else {
            $message="Mot de passe incorrect";
        }
    } else {
        $message="Email introuvable";
    }
}else{
    $message="Veuillez remplir tous les champs";
}
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Connexion</h1>

    <?php if($message): ?>
        <p style="color:red;"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

    <form method="POST" action="login.php">
        <label for="email">Email :</label><br>
        <input type="email" name="email" required><br><br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
    
    <p style="text-align: center; color:black; font-size: 18px;">Pas encore de compte? <a href="register.php">S'inscrire maintenant</a> </p>
    
</body>
</html>
