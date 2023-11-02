<?php   
require_once("../Controller/traitement_contact.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un contact</title>
    <link rel="stylesheet" href="styles/add.css">
</head>
<body>
<form action="add_contact.php" method="POST">
                <h2>Ajouter un contact</h2>
                <label for="Prenom">Prenom:</label><br>
                <input type="text" name="Prenom"><br>
                <label for="Nom">Nom:</label><br>
                <input type="text" name="Nom"><br>
                <label for="Telephone">Téléphone:</label><br>
                <input type="tel" name="telephone"><br>
                <label for="favori">Favoris:</label><br>
                <select name="favori">
                    <option value="yes">OUI</option>
                    <option value="no">NON</option>
                </select><br>
                <button type="submit" name="add_contact">Ajouter</button>
                <a href="contacts.php">Mes contacts</a>
            </form>
            
</body>
</html>