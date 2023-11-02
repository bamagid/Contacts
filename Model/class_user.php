<?php
require_once("class_database.php");
require_once("interface_user.php");
class Utilisateurs extends Database  implements Interfaceuser{
    private $Nom;
    private $Email;
    private $MotDePass;
    private $ConfirmPass;
    public function __construct(){
        parent::__construct();
    }
     public function getNom() {
        return $this->Nom;
    }
    public function setNom($Nom) {
        $this->Nom = $Nom;
    }
    public function getEmail() {
        return $this->Email;
    }
    public function setEmail($Email) {
        $this->Email = $Email;
    }
    public function getMotDePass() {
        return $this->MotDePass;
    }
    public function setMotDePass($MotDePass) {
        $this->MotDePass = $MotDePass;
    }

    public function getConfirmPass() {
        return $this->ConfirmPass;
    }
    public function setConfirmPass($ConfirmPass) {
        $this->ConfirmPass = $ConfirmPass;
    }

     function Inscription($nom,$email,$motdepass,$confirmpass){
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            if(isset($_POST['signup']) && !empty($_POST['pseudo1']) && !empty($_POST['email1']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {   
                $erreurs=[];
            if(!preg_match("/^[a-zA-Z][a-zA-Zàéùè -]{2,100}$/", $nom)) {
               array_push($erreurs,"veuillez entrer un nom d'utilisateur valide");
             }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($erreurs,"l'e-mail n'est pas valide");
            }elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $all_users=self::$conn->prepare("SELECT * FROM user WHERE email=:mail");
                $all_users->execute(['mail'=>$email]);
                if ($all_users->rowCount()>=1) {
                    array_push($erreurs,"L'email que vous avez mis est deja associé a un compte");
                }
            }
            if (strlen($motdepass)>256 && strlen($confirmpass)>256) {
                array_push($erreurs,"le mot de passe ne doit pas depasser 256 caracteres");
            }
            if ($motdepass!= $confirmpass){
                array_push($erreurs,"les mots de passes sont different");
               }
                if(count($erreurs)===0){
                  // Insertion des infos de l'utilisateur dans la base de données
                $insert =self::$conn->prepare("INSERT INTO user (nom,email,password) VALUES (:nom, :email, :password)");
                $insert->execute(array(
                    'nom' => $nom,
                    'email' => $email,
                    'password' => $motdepass
                ));
                // echo '<h2 style="color:green;">Bravo votre inscription a reussie ! </h2>';
            }else{
                foreach ($erreurs as $err) { 
                    echo '<ul><li style"color:red;">'.$err.'</li></ul>';
                    }};
                    };
                }
                }
    function Connexion($email,$pass){
        // Démarrer ou reprendre la session
    session_start();

    // Détruire complètement la session précédente, s'il y en a une
    session_destroy();
            session_start();
            if (isset($_POST['connect']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            //Faire une requete preparée et l'executer
            $query =self::$conn->prepare("SELECT * FROM user WHERE email = :email AND password = :mdp ");
            $query->execute(array(
                'email' => $email,
                'mdp'=>$pass
        ));
            //Verifier si la requete a renvoyer une ligne pour confirmer que l'utilisateur existe dans la BDD
            if ($query->rowCount() === 1) {
                $user = $query->fetch();
                $_SESSION['user']= $user;
                    header("location:../Views/contacts.php");
            } else {
                echo "Désolé, les identifiants que vous avez entrés sont incorrects.";
            }
           };
        }
        
     
    function Reset(){
        if ($_SERVER['REQUEST_METHOD']="POST") {
            if (isset($_POST['reset1'])) {
            $mail_for_reset=htmlspecialchars($_POST['email1']);
            $new_password=md5(htmlspecialchars($_POST['passwordr1']));
            $confirm_password=md5(htmlspecialchars($_POST['passwordr2']));
            if ($new_password===$confirm_password) {
                $reset_verif=self::$conn->prepare("SELECT * FROM user WHERE email=:mail");
                $reset_verif->execute(array(
                    'mail'=>$mail_for_reset
                ));
                if ($reset_verif->rowCount() === 1) {
                    $update_password=self::$conn->prepare("UPDATE user SET password=:mdp WHERE email=:mail");
                    $update_password->execute(array(
                        'mdp'=>$new_password,
                        'mail'=>$mail_for_reset
                    ));
                    echo '<p style="color: green; text-align:center;"><b>Bravo votre mot de passe a été changé avec succés! </b></p>';
                }else {
                    echo "Ce compte n'existe pas, si vous n'avez pas encore de compte veuillez en ouvrir un merci! ";
                }
            }else {
                echo "Veuillez saisir des mots de passe identiques";
            }
            }
        }
    }
}
