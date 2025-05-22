
<style>
body {
    padding: 0px 0;
   }

.header .flex .logo {
    font-size: 2rem;
    color:white;
    font-weight: bold;
    text-decoration: none;
}

.header {
    position: sticky;
    top: 0;
    left: 0;
    right: 0;
    box-shadow:#6a016c;
    z-index: 1000;
    padding: 1rem;
    background-color:#6a016c;
}

.header .flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
}
.header .flex .navbar {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.header .flex .navbar a {
    font-size: 1rem;
    font-family:cursive;
    color:rgb(16, 1, 11);
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.header .flex .navbar a:hover {
    color:azure;
    background:rgb(165, 87, 141);
}
</style>

</head>
<body>
  <header class="header">
    <div class="flex">
    <a href="index.php" class="logo">L📖B</a>    
    <nav class="navbar">
     <?php if(!isset($_SESSION['nom'])): ?>
        <a href="login.php">Se connecter</a>
        <a href="register.php">Créer un compte</a>
        <?php else: ?>
        <a href="index.php"> Accueil</a>
        <a href="historique_cmds.php"> Mes commandes</a>
        <a href="panier.php">🛒 Voir panier</a>
        <a href="logout.php">Se déconnecter</a>
      <?php endif; ?>
    
    </nav>
    </div>
</header>
</body>