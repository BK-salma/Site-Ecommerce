<?php
session_start();
require_once 'includes/db.php';

//parite de filtrage et recherche:
$where="WHERE 1";
$mot_cle='';
$categorie_id='';

//Recherche par mot cle simple:
if(!empty($_GET['mot_cle'])) {
    $mot_cle=mysqli_real_escape_string($conn, $_GET['mot_cle']);
    $where.=" AND(p.nom LIKE '%$mot_cle%' OR p.description LIKE '%$mot_cle%')";
}

// Recherche par categorie detaille
if(!empty($_GET['categorie_id'])) {
    $categorie_id= $_GET['categorie_id'];
    $where.=" AND p.categorie_id='$categorie_id' ";
}

//le tri par prix: asc et desc
$order = "ORDER BY p.id DESC"; //pour l'initializer
if(!empty($_GET['tri'])) {
  if($_GET['tri']==='asc'){
    $order="ORDER BY p.prix ASC";
    }elseif($_GET['tri']==='desc'){
        $order="ORDER BY p.prix DESC";
    }
}

//requette = recuperer tos les prods qui sont same categorie
$q="SELECT p.*, c.nom AS categorie 
          FROM produits p 
          LEFT JOIN categories c 
          ON p.categorie_id = c.id
          $where
          $order";

$res= mysqli_query($conn,$q);
$produits= mysqli_fetch_all($res,MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Boutique</title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
  <?php require_once 'header.php' ?>
    </nav>
    </div>
</header>


  <h1 style="font-family:cursive; font-size:3rem; padding: 50px ;">
    Bienvenue sur Ma LB Librairie en ligne 
    <?= isset($_SESSION['nom']) ? htmlspecialchars($_SESSION['nom']) : '' ?>
  </h1>

  <p style="text-align: center; color: #6a016c; font-size: 2rem; font-family:fantasy;">
    Découvrez une large sélection de livres pour tous les goûts : romans, sciences, histoire, développement personnel et bien plus encore...</p><br>

  <p style="text-align: center; color: #2c3e50; font-size: 1.5rem; font-family:monospace; padding: 50px ;">
    Commandez en quelques clics et recevez vos livres rapidement chez vous !</p>
                
    <br>
           <!-- Rubrique : Recherche et filtrage Produits -->
                <form method="GET" >
                    <!-- recherche -->
                    <input type="text" name="mot_cle" placeholder="Rechercher un livre..." value="<?= isset($_GET['mot_cle']) ? htmlspecialchars($_GET['mot_cle']) : '' ?>">
                    <!-- par categ -->
                    <select name="categorie_id">
                        <option value="">-- Toutes les catégories --</option>
                        <?php 
                           $categories=mysqli_query($conn, "SELECT * FROM categories");
                           while($cat=mysqli_fetch_assoc($categories)) {
                               $selected=(isset($_GET['categorie_id']) && $_GET['categorie_id']==$cat['id']) ? 'selected' : '';
                               echo"<option value=\"{$cat['id']}\"$selected>".htmlspecialchars($cat['nom'])."</option>";
                            }
                            ?>
                    </select>
                    
                    <!-- par Prix -->
                    <select name="tri">
                        <option value="">-- Trier par prix --</option>
                        <option value="asc"<?=(isset($_GET['tri']) && $_GET['tri']=='asc')?'selected' :'' ?>> prix ⬆️</option>
                        <option value="desc"<?=(isset($_GET['tri']) && $_GET['tri']=='desc')?'selected' :'' ?>> prix ⬇️</option>
                    </select>

                    <button type="submit">Filter</button>
                </form>
                
        
    <div class="produits">
        <?php foreach($produits as $produit): ?>
            <div class="produit" style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">  
                <h3><?= htmlspecialchars($produit['nom']) ?></h3>
                <br>
                <?php if(!empty($produit['image'])): ?>
                    <img src="uploads/produits/<?= htmlspecialchars($produit['image']) ?>" 
                    style="max-width:150px;" >
                    <?php endif; ?>
                    
                    <p><strong>Catégorie:</strong><?= htmlspecialchars($produit['categorie']) ?></p>
                    <p><strong>Prix:</strong> <?=$produit['prix']?> DH</p>
                    
                    <a href="prod_detailles.php?id=<?= $produit['id'] ?>">Plus detaille </a>
                    
                    <form method="POST" action="ajouter_panier.php"  >
                        <input type="hidden" name="produit_id" value="<?= $produit['id'] ?>">
                        <input type="number" name="quantite" value="1" min="1" 
                               style="width:50px" required>
                        <a href="ajouter_panier.php"><button type="submit">Ajouter au panier</button></a>
                    </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>