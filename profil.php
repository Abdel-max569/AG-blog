<?php  
session_start()   ;
if (!isset($_SESSION["id"])){
    header("Location:connexion.php");
};



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
                <span class="value">NomUtilisateur</span> 
            </div>
            <div class="info-item">
                <span class="label">Email: </span>
                <span class="value">utilisateur@example.com</span> 
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
                    <!-- Exemple d'article 1 -->
                    <tr>
                        <td>Introduction au CSS moderne</td>
                        <td>2024-10-20</td>
                        <td>
                            <button class="btn-action btn-modifier">Modifier</button>
                            <button class="btn-action btn-supprimer">Supprimer</button>
                        </td>
                    </tr>
                    <!-- Exemple d'article 2 -->
                    <tr>
                        <td>Guide du débutant en HTML5</td>
                        <td>2024-10-15</td>
                        <td>
                            <button class="btn-action btn-modifier">Modifier</button>
                            <button class="btn-action btn-supprimer">Supprimer</button>
                        </td>
                    </tr>
                    <!-- Exemple d'article 3 -->
                    <tr>
                        <td>Pourquoi le PHP est toujours pertinent</td>
                        <td>2024-10-01</td>
                        <td>
                            <button class="btn-action btn-modifier">Modifier</button>
                            <button class="btn-action btn-supprimer">Supprimer</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        
        <a href="#" class="btn-logout">Se déconnecter</a>
    </div>
</body>
</html>
