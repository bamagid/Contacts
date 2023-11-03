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
    $favoris=htmlspecialchars($_POST['favori']);
    $contact= new Contacts();
    $contact->Add_contact($prenom,$nom, $telephone,$favoris,$id_user);
}
if (isset($_SESSION['user'])) {
    $contact= new Contacts();
    $contact->List_contact();
    $contact->List_Favoris();
}else {
    header("Location:../Views/form.php");
}
if (isset($_POST['update'])) {
    session_start();
    $list=htmlspecialchars($_POST['update']);
    $_SESSION['id']=$list;
   header("location: update_contact.php");
}
if (isset($_POST['modifier_contacts'])) {
    $contact_id=$_SESSION['id'][0];
    $prenom=htmlspecialchars($_POST['Prenom']);
    $nom=htmlspecialchars($_POST['Nom']);
    $telephone=htmlspecialchars($_POST['Telephone']);
    $contact= new Contacts();
    $contact->Update_contact($contact_id,$prenom,$nom,$telephone);
    header("Location:../Views/contacts.php");
}
if (isset($_POST['delete'])) {
    $contact_id=$_POST['delete'];
    $contact= new Contacts();
    $contact->Delete_contact($contact_id);
    header("Location:../Views/contacts.php");
    
}
if (isset($_POST['Favoris'])) {
    $contact_id=$_POST['Favoris'];
    $contact= new Contacts();
    $contact->marquer_favoris($contact_id);
    header("Location:../Views/contacts.php");
}
if (isset($_POST['undo'])) {
    $contact_id=$_POST['undo'];
    $contact= new Contacts();
    $contact->supprimer_Favoris($contact_id);
    header("Location:../Views/favoris.php");
}

