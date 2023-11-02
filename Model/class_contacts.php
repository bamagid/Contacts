<?php  
require_once("class_database.php");
class Contacts extends Database{
    private $id;
    private $prenom;
    private $nom;
    private $telephone;
    private $favoris;
 function __construct(){
    parent::__construct();
 }
 function List_contact(){
    if (!isset($_SESSION['contacts'])) {
        $_SESSION['contacts']=[];
    }
        // Exécution la requête SQL pour récupérer les contacts qui ne sont pas dans les favoris.
        $sql = "SELECT * FROM  vuecontacts WHERE id_user=:id";
        $result = self::$conn->prepare($sql);
        $result->execute([
            'id'=>$_SESSION['user']['id']
        ]);
    
        $contactsList = [];
    
        if ($result->rowCount() > 0) {
            // Convertir le résultat en un tableau d'objets ou de tableaux associatifs selon vos besoins.
                $contactsList=$result->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['contacts']=$contactsList;
                return $contactsList;
        }
        
        
    
 }
 function List_Favoris(){ 
    if (!isset($_SESSION['Favoris'])) {
        $_SESSION['Favoris']=[];
    }
    // Exécutez la requête SQL pour récupérer les contacts qui ne sont pas dans les favoris.
    $sql = "SELECT * FROM  vuefavoris WHERE id_user = :id";

    $resultat = self::$conn->prepare($sql);
    $resultat->execute([
        'id'=>$_SESSION['user']['id'],
    
    ]);
    $Favoris_list = [];

    if ($resultat->rowCount() > 0) {
        // Convertir le résultat en un tableau d'objets ou de tableaux associatifs selon vos besoins.
            $Favoris_list=$resultat->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['Favoris']=$Favoris_list;
    }

    return $Favoris_list;
}
 function Add_contact($prenom,$nom, $telephone,$favoris,$id_user){
    if (!preg_match("/^[a-zA-Z -]{2,70}$/", $prenom)) {
        echo "Veuillez entrer un prénom valide";
    } elseif (!preg_match("/^[a-zA-Z]{2,30}$/", $nom)) {
        echo "Veuillez entrer un nom valide";
    } elseif (!preg_match("/^7[05768]{1}+[0-9]{7}$/", $telephone)) {
        echo "Le numéro de téléphone est invalide";
    } elseif (!in_array($favoris, ['yes', 'no'])) {
        echo "Veuillez choisir favoris ou non favoris";
    } else {
        // Exécutez la requête SQL d'insertion pour ajouter le contact.
        $insert =self::$conn->prepare("INSERT INTO contacts (Prenom, Nom, Telephone, Favoris,id_user) VALUES (:prenom, :nom, :telephone, :favoris,:id_user )");
        $insert->execute([
            'prenom' => $prenom,
            'nom' => $nom,
            'telephone' => $telephone,
            'favoris' => $favoris,
            'id_user' => $id_user,
        ]);
        echo '<p style="color: green; text-align:center;"><b>Bravo votre contact a été ajouté avec succés!</b></p>';
    }
 }
 function Update_contact($contact_id, $prenom, $nom, $telephone) {
    if(!preg_match("/^[a-zA-Z][a-zA-Z -]{2,70}$/",$prenom)) {
        echo"veuillez entrer un prenom valide";
    }elseif (!preg_match("/[a-zA-Z]{2,30}$/", $nom)) {
        echo"veuillez entrer un nom valide";
    }elseif(!preg_match("/^7[05768]{1}+[0-9]{7}$/",$telephone)){
        echo "le numéro de téléphone est invalide";
    }else{
        // Exécutez la requête SQL de mise à jour pour le contact spécifié.
        $update=self::$conn->prepare("UPDATE contacts SET Prenom =:prenom, Nom =:nom , Telephone = :telephone WHERE id = :id ");
        $update->execute([
        'id' => $contact_id,
        'prenom'=>$prenom,
        'nom'=>$nom,
        'telephone'=>$telephone,
       ]);
        echo '<p style="color: green; text-align:center;"><b>Bravo votre inscription a reussie!</b></p>';
        }}
        function Delete_Contact($contact_id){
            $delete=self::$conn->prepare("UPDATE contacts SET is_deleted='yes' WHERE id = :id");
            $delete->execute([
                'id'=>$contact_id
            ]);}
        function  Marquer_favoris($contact_id)  {
            $delete=self::$conn->prepare("UPDATE contacts SET Favoris='yes' WHERE id = :id");
            $delete->execute([
                'id'=>$contact_id
            ]);}
        
}