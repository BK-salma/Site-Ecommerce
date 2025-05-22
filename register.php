<?php
session_start();
require_once 'includes/db.php';

$message='';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom=$_POST['nom'];
    $email =$_POST['email'];
    $password=$_POST['password'];
    $confirm_password =$_POST['confirm_password'];

    if(!empty($nom) && !empty($email) && !empty($password) && !empty($confirm_password)) {
        
        if($password===$confirm_password) {
            $check_email=mysqli_query($conn,"SELECT id FROM users WHERE email ='$email'");

            if(mysqli_num_rows($check_email)===0) {

                $hash= password_hash($password,PASSWORD_DEFAULT);
                $inserer="INSERT INTO users(nom,email,password,role) 
                          VALUES ('$nom','$email','$hash','client')";

                $res=mysqli_query($conn,$inserer);

                if($res){
                    $message ="Compte créé avec succès.";
                }else{
                    $message="Erreur lors de la création du compte.";
                }
            }else{
                $message ="Email déjà utilisé.";
            }
        }else{
            $message= "Les mots de passe ne correspondent pas.";
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Créer un compte</h1>

    <?php if($message): ?>
        <p style="color:red; font-size: 18px;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Nom :</label><br>
        <input type="text" name="nom" required><br><br>

        <label>Email :</label><br>
        <input type="email" name="email" required><br><br>

        <label>Mot de passe :</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirmer le mot de passe :</label><br>
        <input type="password" name="confirm_password" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>
    
    <p style="text-align: center; color:black; font-size: 18px;">Deja un compte? <a href="login.php">Se connecter</a> </p>


</body>
</html>
