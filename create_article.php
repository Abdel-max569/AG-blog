<?php
session_start();
$id_user=$_SESSION["id"];
require "utils/fileArt.php";

if (!isset($_SESSION["id"])) {
    header("Location:connexion.php");
}

$allArticle = readJson();


if (isset($_POST["publier"])) {

    $title = htmlspecialchars($_POST["title"]);
    $nomFichier = $_FILES['file']['name'];
    $tailleFichier = $_FILES['file']['size'];
    $typeFichier = $_FILES['file']['type'];
    $cheminTemporaire = $_FILES['file']['tmp_name'];

    $resume = htmlspecialchars($_POST["resume"]);
    $content = nl2br(htmlspecialchars($_POST["content"]));
    $id_unique = uniqid();
    $dateInscri = date("Y-m-d");
    $categorie_selectionnee = $_POST['category'];
    $id_unique = uniqid();
    $datepost = date("Y-m-d");


    $dossier_destination = '/home/abdel/semestre3/TP_HTML/boostrap/img/' . $nomFichier;

    if (move_uploaded_file($cheminTemporaire, $dossier_destination)) {
        //echo "Le fichier a été déplacé avec succès.";
    } else {
        echo "Erreur lors du déplacement du fichier.";
    }
    $user = [
        "id" => $id_unique,
        "title" => $title,
        "sous_title" => $resume,
        "content" => $content,
        "img" => $nomFichier,
        "categorie" => $categorie_selectionnee,
        "date_post" => $datepost,
        "id_user"=>$id_user
    ];


    
    $allArticle[] = $user;
    //var_dump($allArticle);
    writeJson($allArticle);

    header("Location:index.php");
}











?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Nouvel Article de Blog</title>
    <link rel="stylesheet" href="assets/create_article.css">

    </script>
</head>

<body>
    <header>
        <div class="container">
            <h1>Créer un Nouvel Article</h1>
        </div>
    </header>

    <main class="container">
        <form action="create_article.php" method="POST" class="article-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Titre de l'article</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                <input type="file" class="form-control" id="inputGroupFile01" name="file">
            </div>

            <div class="form-group">
                <label for="excerpt">Extrait (résumé)</label>
                <textarea id="excerpt" name="resume" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="content">Contenu de l'article</label>
                <textarea id="content" name="content" rows="15" required></textarea>
            </div>

            <div class="form-group">
                <label for="category">Catégorie</label>
                <select id="category" name="category">
                    <option value="tech">Technologie</option>
                    <option value="lifestyle">Style de vie</option>
                    <option value="travel">Voyage</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit" name="publier">Publier l'article</button>
            </div>
        </form>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Mon Blog</p>
        </div>
    </footer>
</body>

</html>