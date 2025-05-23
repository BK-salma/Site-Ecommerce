
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Boutique</title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
  
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
             <a href="index.php"> Accueil</a>
        <a href="historique_cmds.php"> Mes commandes</a>
        <a href="panier.php">🛒 Voir panier</a>
        <a href="logout.php">Se déconnecter</a>
          
    </nav>
    </div>
</header>
</body>    </nav>
    </div>
</header>


  <h1 style="font-family:cursive; font-size:3rem; padding: 50px ;">
    Bienvenue sur Ma LB Librairie en ligne 
    safae  </h1>

  <p style="text-align: center; color: #6a016c; font-size: 2rem; font-family:fantasy;">
    Découvrez une large sélection de livres pour tous les goûts : romans, sciences, histoire, développement personnel et bien plus encore...</p><br>

  <p style="text-align: center; color: #2c3e50; font-size: 1.5rem; font-family:monospace; padding: 50px ;">
    Commandez en quelques clics et recevez vos livres rapidement chez vous !</p>
                
    <br>
           <!-- Rubrique : Recherche et filtrage Produits -->
                <form method="GET" >
                    <!-- recherche -->
                    <input type="text" name="mot_cle" placeholder="Rechercher un livre..." value="">
                    <!-- par categ -->
                    <select name="categorie_id">
                        <option value="">-- Toutes les catégories --</option>
                        <option value="1"> Romans</option><option value="2">Histoire</option><option value="3">Science-Fiction</option><option value="4">Fantasy</option><option value="5">Biographie</option><option value="6">Aventure </option><option value="7">Romance</option>                    </select>
                    
                    <!-- par Prix -->
                    <select name="tri">
                        <option value="">-- Trier par prix --</option>
                        <option value="asc"> prix ⬆️</option>
                        <option value="desc"> prix ⬇️</option>
                    </select>

                    <button type="submit">Filter</button>
                </form>
                
        
    <div class="produits">
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>Alexandria Marzano-Lesnevich - The Fact of a Body</h3>
                <br>
                                    <img src="uploads/produits/14.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong>Biographie</p>
                    <p><strong>Prix:</strong> 250.00 DH</p>
                    
                    <a href="prod_detailles.php?id=17">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="17">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>Amy Ewing - The Jewel </h3>
                <br>
                                    <img src="uploads/produits/9.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong>Science-Fiction</p>
                    <p><strong>Prix:</strong> 150.00 DH</p>
                    
                    <a href="prod_detailles.php?id=16">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="16">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>Victoria Aveyard - Red Queen </h3>
                <br>
                                    <img src="uploads/produits/11.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong>Fantasy</p>
                    <p><strong>Prix:</strong> 100.00 DH</p>
                    
                    <a href="prod_detailles.php?id=15">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="15">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>Kate Morton </h3>
                <br>
                                    <img src="uploads/produits/1.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong>Romance</p>
                    <p><strong>Prix:</strong> 95.00 DH</p>
                    
                    <a href="prod_detailles.php?id=14">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="14">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>C.J. Redwine - Defiance</h3>
                <br>
                                    <img src="uploads/produits/8.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong>Fantasy</p>
                    <p><strong>Prix:</strong> 90.00 DH</p>
                    
                    <a href="prod_detailles.php?id=13">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="13">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>Bella Forrest - A Shade of Vampire </h3>
                <br>
                                    <img src="uploads/produits/17.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong>Fantasy</p>
                    <p><strong>Prix:</strong> 195.00 DH</p>
                    
                    <a href="prod_detailles.php?id=12">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="12">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>Mary Stuart - Duas Rainhas</h3>
                <br>
                                    <img src="uploads/produits/20.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong>Histoire</p>
                    <p><strong>Prix:</strong> 195.00 DH</p>
                    
                    <a href="prod_detailles.php?id=11">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="11">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>Paul La Farge - The Night Ocean</h3>
                <br>
                                    <img src="uploads/produits/18.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong> Romans</p>
                    <p><strong>Prix:</strong> 100.00 DH</p>
                    
                    <a href="prod_detailles.php?id=10">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="10">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>Paul Torday - Light Shining in the Forest</h3>
                <br>
                                    <img src="uploads/produits/16.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong>Aventure </p>
                    <p><strong>Prix:</strong> 75.00 DH</p>
                    
                    <a href="prod_detailles.php?id=9">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="9">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>Tahereh Mafi - Ignite Me</h3>
                <br>
                                    <img src="uploads/produits/6.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong>Romance</p>
                    <p><strong>Prix:</strong> 80.00 DH</p>
                    
                    <a href="prod_detailles.php?id=8">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="8">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>Alexa Chung - It </h3>
                <br>
                                    <img src="uploads/produits/3.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong>Biographie</p>
                    <p><strong>Prix:</strong> 55.00 DH</p>
                    
                    <a href="prod_detailles.php?id=7">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="7">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
                    <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3>Seanan McGuire- De Volta Para Casa</h3>
                <br>
                                    <img src="uploads/produits/2.jpg" 
                    style="max-width:150px;" >
                                        
                    <p><strong>Catégorie:</strong>Romance</p>
                    <p><strong>Prix:</strong> 50.00 DH</p>
                    
                    <a href="prod_detailles.php?id=5">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="5">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <button type="submit">Ajouter au panier</button>
                    </form>
            </div>
            </div>
</body>
</html>