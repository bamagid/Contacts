<?php
require_once("../Model/class_user.php");
require_once("../Model/class_database.php");
if(isset($_POST['signup'])){
    $nom = htmlspecialchars($_POST['pseudo1']);
    $email = htmlspecialchars($_POST['email1']);
    $motdepass =md5(htmlspecialchars($_POST['password1']));
    $confirmpass =md5(htmlspecialchars($_POST['password2']));
    $user= new Utilisateurs();
    $user->Inscription($nom,$email,$motdepass,$confirmpass);
}
if(isset($_POST['connect'])){
    $email =htmlspecialchars($_POST['email']);
    $pass =md5(htmlspecialchars($_POST['password']));
    $user= new Utilisateurs();
    $user->Connexion($email,$pass);
}
if (isset($_POST['reset1'])) {
    $user= new Utilisateurs();
    $user->Reset();
}