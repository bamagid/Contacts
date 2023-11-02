<?php
interface Interfaceuser{
     public function Inscription($nom,$email,$motdepass,$confirmpass);
     public function Connexion($email,$pass);
     public function Reset();
}