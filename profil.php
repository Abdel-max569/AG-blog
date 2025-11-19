<?php 
session_start()   ;
require "utils/fileArt.php"; 
if (!isset($_SESSION["id"])){
    header("Location:connexion.php");
};

$id_user=$_SESSION["id"];
$nom_profil=$_SESSION["nom"];
$email_profil=$_SESSION["email"];


$allarticle=readJson();


$allart_user=[];
foreach ($allarticle as $article){
    if ($id_user==$article["id_user"]){
        $allart_user[]=$article;
    }
}

//var_dump($allart_user);










?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil Utilisateur (Design Statique)</title>
    <link rel="stylesheet" href="assets/profil.css">
</head>
<body>
    <div class="container">
        <h1>Mon Profil</h1>
       

        <section class="info-profil">
            <h3>Mes Informations Personnelles</h3>
            <div class="info-item">
                <span class="label">Nom d'utilisateur :</span>
                <span class="value"><?=$nom_profil?></span> 
            </div>
            <div class="info-item">
                <span class="label">Email: </span>
                <span class="value"><?=$email_profil?></span> 
            </div>
          
        </section>

        <section class="mes-articles">
            <h3>Mes Articles Publiés</h3>
            <table>
                <thead>
                    <tr>
                        <th>Titre de l'article</th>
                        <th>Date de publication</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allart_user as $article): ?>
                    <tr>
                        <td><?=$article["title"]?></td>
                        <td><?=$article["date_post"]?></td>
                        <td>
                            <a href=""><button class="btn-action btn-modifier">Modifier</button></a>
                            <a href="delete.php?id=<?= $article["id"] ?>"><button class="btn-action btn-supprimer">Supprimer</button></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        
        <a href="logout.php" class="btn-logout">Se déconnecter</a>
    </div>
</body>
</html>
