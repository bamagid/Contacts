<?php
require_once("../Model/class_contacts.php");
if (isset($_POST['deconnect'])) {
    session_start();
    unset($_SESSION['user']);
    header("Location:../Views/form.php");
       ;}
if (isset($_POST['add_contact'])) {
    session_start();
    $prenom=htmlspecialchars($_POST['Prenom']);
    $nom=htmlspecialchars($_POST['Nom']);
    $telephone=htmlspecialchars($_POST['telephone']);
    $id_user=htmlspecialchars($_SESSION['user']['id']);
    $favoris=htmlspecialchars($_POST['Favoris']);
    $contact= new Contacts();
    $contact->Add_contact($prenom,$nom, $telephone,$favoris,$id_user);
}
if (isset($_SESSION['user'])) {
    $contact= new Contacts();
    $contact->List_contact();
    $contact->List_Favoris();
}
if (isset($_POST['update'])) {
    session_start();
    $id_contact=htmlspecialchars($_POST['update']);
    $_SESSION['id']=$id_contact;
   header("location: update_contact.php");
}
if (isset($_POST['modifier_contacts'])) {
    $contact_id=$_SESSION['id'];
    $prenom=htmlspecialchars($_POST['Prenom']);
    $nom=htmlspecialchars($_POST['Nom']);
    $telephone=htmlspecialchars($_POST['Telephone']);
    $contact= new Contacts();
    $contact->Update_contact($contact_id,$prenom,$nom,$telephone);
}
if (isset($_POST['delete'])) {
    $contact_id=$_SESSION['id'];
    $contact= new Contacts();
    $contact->Delete_contact($contact_id);
    header("location: contacts.php");
}
if (isset($_POST['Favoris'])) {
    $contact_id=$_SESSION['id'];
    $contact= new Contacts();
    $contact->marquer_favoris($contact_id);
    header("location: contacts.php");
}

