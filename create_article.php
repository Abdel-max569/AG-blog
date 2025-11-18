<?php

session_start();

// // Vérifier la session AVANT d'accéder à $_SESSION["id"]
// if (!isset($_SESSION["id"])) {
//     header("Location: connexion.php");
//     exit();
// }
// $id_user = $_SESSION["id"];

// require "utils/fileArt.php";

// $allArticle = readJson();

// if (isset($_POST["publier"])) {

//     $title = htmlspecialchars($_POST["title"]);
//     $resume = htmlspecialchars($_POST["resume"]);
//     $content = nl2br(htmlspecialchars($_POST["content"]));
//     $categorie_selectionnee = htmlspecialchars($_POST['category']);
//     $id_unique = uniqid();
//     $datepost = date("Y-m-d");

//     // Gestion sécurisée du fichier uploadé
//     $imgFilename = null;
//     if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
//         $tmpPath = $_FILES['file']['tmp_name'];
//         $origName = $_FILES['file']['name'];
//         $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
//         $allowed = ['jpg','jpeg','png','gif'];

//         if (in_array($ext, $allowed)) {
//             // Générer un nom unique pour éviter collisions et attaques
//             $imgFilename = time() . '_' . uniqid() . '.' . $ext;
//             $destDir = __DIR__ . '/img/';
//             if (!is_dir($destDir)) {
//                 mkdir($destDir, 0755, true);
//             }
//             $destPath = $destDir . $imgFilename;
//             if (!move_uploaded_file($tmpPath, $destPath)) {
//                 // échec du déplacement — on peut logguer ou afficher une erreur
//                 $imgFilename = null;
//             }
//         } else {
//             // type non autorisé — ignorer le fichier ou gérer l'erreur
//             $imgFilename = null;
//         }
//     }

//     $user = [
//         "id" => $id_unique,
//         "title" => $title,
//         "sous_title" => $resume,
//         "content" => $content,
//         "img" => $imgFilename ?? '',
//         "categorie" => $categorie_selectionnee,
//         "date_post" => $datepost,
//         "id_user" => $id_user
//     ];

//     $allArticle[] = $user;
//     writeJson($allArticle);

//     header("Location: index.php");
//     exit();
// }



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
                <input type="text" id="title" name="title" required >
                <p  id="error-caracter" style="color:red"></p>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                <input type="file" class="form-control" id="inputGroupFile01" name="file">
                
            </div>

            <div class="form-group">
                <label for="excerpt">Extrait (résumé)</label>
                <textarea id="excerpt" name="resume" rows="3"></textarea>
                <p  id="error-caracter-resume" style="color:red"></p>
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
    <script src="js/script.js"></script>
</body>


</html>