<?php
session_start();
require "utils/fileArt.php";
require "utils/file.php";

$allArticle = readJson();

$id_user = $_SESSION["id"];

$allUser=readJsonUser();




?>



<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AGS - Blog</title>
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <nav>
    <div class="nav-container">
      <a href="#" class="logo">AGS - Blog</a>
      <ul class="nav-links">
        <li><a href="#">Accueil</a></li>
        <li><a href="create_article.php">Creer</a></li>

        <?php if ($id_user == "6911da36cb848"): ?>
          <li><a href="admin.php">Admin</a></li>
        <?php endif ?>

        <li><a href="Apropos.php">À propos</a></li>
        <li><a href="profil.php">Profil</a></li>
      </ul>
      <?php if (!isset($id_user)): ?>
        <a href="connexion.php" class="cta-btn">Connexion</a>
      <?php else: ?>
        <a href="logout.php" class="cta-btn">Deconnexion</a>
      <?php endif ?>
    </div>
  </nav>

  <div class="hero">
    <div class="hero-content">
      <h1>Explorez les dernières innovations technologiques</h1>
      <p>Découvrez des articles rédigés par des experts du secteur</p>
      <div class="search-bar">
        <input type="text" class="search-input" placeholder="Rechercher un article">
        <button class="search-btn">Rechercher</button>
      </div>
    </div>
  </div>


  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Articles récents</h2>
    </div>


    <div class="articles-grid">
      <?php foreach ($allArticle as $article) : ?>
        <div class="article-card">
          <a href="details.php?id=<?= $article['id'] ?>">
            <div class="article-image">
              <img src="img/<?= $article["img"] ?>" alt="<?= $article["title"] ?>">
            </div>
            <div class="article-content">
              <div class="article-meta">
                <?php 
              $nom = "Inconnu"; 
              foreach ($allUser as $user){
                if ($article["id_user"] == $user["id"]){
                  $nom = $user["nom"];
                  $avatar=substr($nom, 0, 2);
                  
                  break;
                }
              }
            ?>
                <div class="author-avatar"><?= strtoupper($avatar) ?></div>
                <div class="author-info">
                  <span class="author-name"><?=$nom?></span>
                  <span class="article-date"><?= $article["date_post"] ?></span>
                </div>
                <span class="article-category"><?= $article["categorie"] ?></span>
              </div>
              <h3 class="article-title"><?= $article["title"] ?></h3>
              <p class="article-excerpt"><?= $article["sous_title"] ?></p>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>

  </div>

  <footer style="background:#1a1a1a; color:#ddd; padding:50px 20px; font-family:Arial, sans-serif;">
  <div style="display:flex; flex-wrap:wrap; justify-content:space-around; max-width:1200px; margin:0 auto;">
    
    <div style="flex:1; min-width:200px; margin-bottom:20px;">
      <h3 style="color:#fff; border-bottom:2px solid #ff6b6b; padding-bottom:10px;">À propos</h3>
      <p>Un blog passionnant sur la tech, le design et le développement web. Des articles chaque <br>semaine pour rester à jour.</p>
    </div>
    
    <div style="flex:1; min-width:200px; margin-bottom:20px;">
      <h3 style="color:#fff; border-bottom:2px solid #4ecdc4; padding-bottom:10px;">Liens utiles</h3>
      <ul style="list-style:none; padding:0;">
        <li><a href="#" style="color:#ddd; text-decoration:none; margin:5px 0; display:block;">Accueil</a></li>
        <li><a href="#" style="color:#ddd; text-decoration:none; margin:5px 0; display:block;">Articles</a></li>
        <li><a href="apropos.php" style="color:#ddd; text-decoration:none; margin:5px 0; display:block;">À propos</a></li>
        <li><a href="contact.php" style="color:#ddd; text-decoration:none; margin:5px 0; display:block;">Contact</a></li>
      </ul>
    </div>
    
    <div style="flex:1; min-width:200px; margin-bottom:20px;">
      <h3 style="color:#fff; border-bottom:2px solid #9b59b6; padding-bottom:10px;">Suivez-moi</h3>
      <p>Restez connecté pour ne rien manquer.</p>
      <div style="margin-top:10px;">
        <a href="#" style="color:#bbb; margin-right:15px; font-size:1.2em;background-color:black;border-radius: 50%;padding: 10px;">@</a>
        <a href="#" style="color:#bbb; margin-right:15px; font-size:1.2em;background-color:black;border-radius: 50%;padding: 10px;">f</a>
        <a href="https://www.linkedin.com/in/abdel-agouda-239a95356" target="_blank" style="color:#bbb; margin-right:15px; font-size:1.2em;background-color:black;border-radius: 50%;padding: 10px;">in</a>
      </div>
    </div>
  </div>
  <hr style="border:0; border-top:1px solid #333; margin:30px 0;">
  <p style="text-align:center; color:#999;">&copy; 2025 AGS - Blog. Tous droits réservés.</p>
</footer>  





</body>

</html>