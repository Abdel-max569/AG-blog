<?php
session_start();
if (!isset($_SESSION["id"])){
    header("Location:connexion.php");
};
require "utils/fileArt.php"; 

$id_art=$_GET["id"];
var_dump($id_art);

$allArticle=readJson();

$index_to_delete = null;

foreach ($allArticle as $index => $article) {
    if ($article["id"] == $id_art) {
        $index_to_delete = $index;
        break; 
    }
}


//var_dump($index_to_delete);


if ($index_to_delete !== null) {
    unset($allArticle[$index_to_delete]);
    writeJson($allArticle);
    header("Location: profil.php?message=Produit supprimé avec succès.");
    exit();
} else {
    header("Location: profil.php?error=Produit non trouvé.");
    exit();
}





?>