<?php 
require_once("../Controller/traitement_user.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link rel="stylesheet" href="styles/pswd_reset.css">
</head>
<body>
    <form action="pswd_reset.php" method="post">
        <h2 class="h21">Reinitialiser mon mot de passe</h2><br>
        <label for="email1">Email:</label><br>
        <input type="email" name="email1" class="entrer" autocomplete="off" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}" required><br>
        <label for="passwordr1">Nouveau mot de passe:</label><br>
        <input type="password" name="passwordr1" class="entrer" required><br>
        <label for="passwordr2">Confirmation:</label><br>
        <input type="password" name="passwordr2" class="entrer" required><br>
        <button type="submit" name="reset1">Reinitialiser</button>
    </form><a href="form.php">Retour sur la page d'accueil</a>
</body>
</html>