<?php
session_start();
require "utils/fileArt.php";

$allArticle = readJson();

$id_user = $_SESSION["id"];



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
                <div class="author-avatar">AD</div>
                <div class="author-info">
                  <span class="author-name">Alexandre Dupont</span>
                  <span class="article-date"><?= $article["date_post"] ?></span>
                </div>
                <span class="article-category">développement</span>
              </div>
              <h3 class="article-title"><?= $article["title"] ?></h3>
              <p class="article-excerpt"><?= $article["sous_title"] ?></p>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>

  </div>





</body>

</html>