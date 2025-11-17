<?php
session_start();
require "utils/file.php";
$allUser=readJsonUser();
//var_dump($allUser);


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Administration - Utilisateurs (Statique)</title>
    <link rel="stylesheet" href="assets/admin.css">
</head>
<body>
    <div class="container">
        <h1>Panneau d'Administration</h1>

        <h2>Liste des Utilisateurs</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>             
                <!-- Ligne d'exemple 2 (Utilisateur) -->
                 <?php foreach ($allUser as $user):?>
                <tr>
                    <td><?=$user["id"]?></td>
                    <td><?=$user["nom"]?></td>
                    <td><?=$user["email"]?></td>
                    <td>utilisateur</td>
                    <td>
                        <button class="action-btn delete-btn">Supprimer</button>
                    </td>
                </tr>
                <?php endforeach ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>
