<?php
session_start();
require_once("../Controller/traitement_contact.php");
$Favoris_list=$_SESSION['Favoris'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details de tâches</title>
    <link rel="stylesheet" href="styles/favoris.css">
</head>

<body>
    <div class="header">
        <h1>Mes contacts favoris</h1><br>
    <?= $_SESSION['user']['Nom'];?>
    </div>
    <div class="taches">
        <?php
        if (!empty($Favoris_list)) {   
        
         foreach ($Favoris_list as $detail) { 
            echo'
        <div class="color">
            <p class="p1"><b>'.$detail['Prenom'].'</b></p>
            <p class="p2"><b>'.$detail['Nom'].'</b></p>
            <p class="Telephone"> '.$detail['Telephone'].'</p>
            <form action="manage_task.php" method="POST">
            <button type="submit" class="button1" name="done">Suprimmer de la liste des favoris</button>
            </form>
        </div>';
        }
    }else {
        echo "Aucun contact favoris n'a ete trouvé";
    }
    ?>
    </div>
    <a href="contacts.php">Retour a la page de contacs</a>
</body>
</html>