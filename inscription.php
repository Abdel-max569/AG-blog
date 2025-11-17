<?php
require "utils/file.php";

$allUsers = readJsonUser();


$exist_user=null;

if (isset($_POST["valide"])) {
    $nom = htmlspecialchars($_POST["nom"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"]; 

    
    $exist_user = null;


    foreach ($allUsers as $user) {
        if ($user["email"] == $email) {
            $exist_user = $user;
            break; 
        }
    }

    if ($exist_user) {
        $error_message = "Un compte avec cette adresse e-mail existe déjà.";
    } else {
        $id_unique = uniqid();
        $dateInscri = date("Y-m-d");
        
        

        $user = [
            "id" => $id_unique,
            "nom" => $nom,
            "email" => $email,
            "password" => $password, // Stocker le mot de passe haché
            "date_inscri" => $dateInscri
        ];

        $allUsers[] = $user;
        writeJsonUser($allUsers);
        
        // Rediriger proprement
        header("Location: connexion.php?registration_success=1");
        exit(); // Toujours appeler exit() après une redirection pour arrêter l'exécution du script
    }
}
    





?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/inscription.css">
</head>

<body>
    <div class="signup-container">
        <h2>Inscription</h2>
        <?php if (!empty($exist_user)):?>
        <p style="color: red;"><?= $error_message ?></p>
        <?php endif ;?>
        <form action="inscription.php" method="post">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <h4> J'ai deja un compte <a href="connexion.php">me connecter</a></h4>
            <button type="submit" name="valide">S'inscrire</button>
        </form>
    </div>
</body>

</html>