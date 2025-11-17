<?php
session_start();
require "utils/file.php";
 
$allUsers=readJsonUser();


if (isset($_POST["connecter"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    foreach($allUsers as $user){
      
      if($user["email"]===$email && $user["password"]===$password){
          // $pseudo_user=$user["nom"];
          // $id_user=$user["id"];
          // $email_user=$user["email"];
          $_SESSION["id"]=$user["id"];
          $_SESSION["nom"]=$user["nom"];
          $_SESSION["email"]=$user["email"];
           header("Location:index.php");
      }
     
      

      

      
    }

   

    
}




?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="assets/connexion.css">
</head>
<body>
  <div class="login-container">
    <h2>Connexion</h2>
    <?php if (isset($connecter)): ?>
    <p><?php $error ?></p>
    <?php endif ;?>

    <form action="#" method="post">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-options">
              <h4> Je n es pas un compte  <a href="inscription.php">m'inscrire</a></h4>
      </div>
      <button type="submit" name="connecter">Se connecter</button>
    </form>
  </div>
</body>
</html>   