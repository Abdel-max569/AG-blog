<?php
session_start();
require "utils/fileArt.php";
require "utils/file.php";
require "utils/fileComment.php";


$allArticle = readJson();
$allUser = readJsonUser();
$allComment=readJsonComment();

// var_dump($allComment);


$idArticle = $_GET["id"];


$product_find = null;
foreach ($allArticle as $article) {
    if ($article["id"] === $idArticle) {
        $product_find = $article;
        break;
    }
};

if ($product_find === null) {
    echo "<h1>Article non trouvé.</h1>";
    exit(); 
}



// var_dump($product_find);


$user_pseudo = "Utilisateur Inconnu"; // Initialisation par défaut
foreach ($allUser as $user) {
    // var_dump($user);
    if ($user["id"] === $product_find["id_user"]) {
        $user_pseudo = htmlspecialchars($user["nom"]); // Sécurisation immédiate
        break;
    }
}

// -------------------------------- COMMENTAIRE------------------------------//


// -------------------------------- ENREGISTREMENT------------------------------//



if (isset($_POST["post"])) {
    if (!isset($_SESSION["id"])) {
        header("Location: connexion.php");
        exit(); 
    }

    $comment = htmlspecialchars($_POST["comment"]);
    // var_dump($comment);
    $comment_one = [
        "id" => $id_unique = uniqid(),
        "id_user" => $_SESSION["id"],
        "id_article" => $idArticle,
        "content" => $comment,
        "date_comment" => $datepost = date("Y-m-d")
    ];
    $allComment[] = $comment_one;
    // var_dump($allComment);
    writeJsonComment($allComment);

    // --- Ajoutez cette redirection après l'enregistrement ---
    header("Location: details.php?id=" . urlencode($idArticle));
    exit(); 
}

// -------------------------------- AFFICHAGE------------------------------//





$allComment_for_art=[];
foreach ($allComment as $comment) {
    if ($comment["id_article"] === $idArticle) {
        $allComment_for_art[] = $comment;
        
    }
};



?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/details.css">
</head>

<body>
    <div class="container">
        <a href="index.html" class="back-btn"><i class="fas fa-arrow-left"></i> Retour</a>

        <h1><?= $product_find["title"] ?></h1>

        <div class="article-meta">
            <span><i class="far fa-calendar"></i> <?= $product_find["date_post"] ?></span>
            <span><i class="far fa-user"></i> <?= $user_pseudo ?></span>
        </div>

        <img src="img/<?= $product_find["img"] ?>" alt="Image de l'article">

        <p><?= $product_find["content"] ?></p>



        <!-- Section Commentaires -->
        <div class="comments-section mt-5">
            <h3 style="color: white;"><i class="fas fa-comments"></i> Commentaires <span class="text-muted" id="comment-count" >(<?=count($allComment_for_art)?>)</span></h3>

            <!-- Affichage des commentaires existants -->
             <?php foreach($allComment_for_art as $comment):?>
                
            <div class="comments-list mt-4">
                
                <div class="d-flex mb-3">
                    <img src="img/avatar2.jpeg" alt="Avatar" class="rounded-circle me-3"
                        style="width: 50px; height: 50px; object-fit: cover;">
                    <div class="comment-body bg-dark p-3 rounded" style="flex: 1;">
                        <strong class="text-white">Marie Dupont</strong>
                        <small class="text-muted d-block"><?=$comment["date_comment"]?></small>
                        <p class="mt-2 text-light"><?=$comment["content"]?></p>
                    </div>
                </div>
                
            </div>
            <?php endforeach?>
            <!--  -->



            <!-- Formulaire pour ajouter un commentaire -->
            <div class="comment-form mt-5">
                <h4><i class="fas fa-pen"></i> Ajouter un commentaire</h4>
                <form class="mt-3" action="details.php?id=<?= htmlspecialchars($idArticle) ?>" method="post">
                    <input type="hidden" name="article_id" value="<?= htmlspecialchars($idArticle) ?>">

                    <div class="mb-3">
                        <textarea class="form-control bg-dark text-light border-secondary" rows="5"
                            placeholder="Votre message..." required name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="post">Publier</button>
                </form>
            </div>
            <footer>
                &copy; 2025 AG-Blog. Tous droits réservés.
            </footer>
        </div>
        
</body>

</html>