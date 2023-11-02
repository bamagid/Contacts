<?php
session_start();
require_once("../Controller/traitement_contact.php");
$list=explode(",",$_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifier contact</title>
    <link rel="stylesheet" href="styles/update.css">
</head>
<body>
<form action="update_contact.php" method="POST">
                <h2>Ajouter un contact</h2>
                <label for="Prenom">Prenom:</label><br>
                <input type="text" name="Prenom" value="<?php echo $list[1];?>"><br>
                <label for="Nom">Nom:</label><br>
                <input type="text" name="Nom" value="<?php  echo $list[2] ;?>"><br>
                <label for="Telephone">Téléphone:</label><br>
                <input type="tel" name="Telephone" value="<?php  echo $list[3] ;?>"><br>
                <button type="submit" name="modifier_contacts">Modifier le contact</button>
                </form>
                <a href="contacts.php">Mes contacts</a>
</body>
</html>