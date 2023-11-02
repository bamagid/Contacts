<?php
session_start();
require_once("../Controller/traitement_contact.php");
$contactsList=$_SESSION['contacts'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord</title>
    <link rel="stylesheet" href="styles/contacts.css">
</head>

<body>

    <div class="header">
        <h1>MES CONTACTS</h1><br>
        <p><?= $_SESSION['user']['Nom'];?></p> 
    </div>
    <form action="contacts.php" class="form" method="post">
        <button type="submit" class="button" name="deconnect" >Se deconnecter</button>
        <a href="favoris.php">Voir mes contacts favoris</a>
        </form>
        <a href="add_contact.php">Ajouter un contact</a>
    
    <?php
        if(!empty($contactsList)){
         foreach($contactsList as $list) {
            echo'
            <div class="corps">
            <p class="p1"><b>'.$list['Prenom'].'</b></p>
            <p class="p2"><b>'. $list['Nom'].'</b></p>
            <p class="Telephone">'.$list['Telephone'].'</p>
            <form action="contacts.php" method="POST">
            <button type="submit" class="button1" name="Favoris" value="'.$list['id'].'">Marquer comme favoris</button>
            <button type="submit" class="button2" name="delete" value="'.$list['id'].'"> Supprimer la contacts </button>
            <button  class="button3" name="update" value="'.$list['id'].'">Modifier le contact</button>
            </form>
    </div>';
}
}else {
    echo "Aucun contact n'a ete trouvé ajouter en un";
}

?>
</body>
</html>