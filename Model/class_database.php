<?php
class Database{
    protected $host = 'localhost:3307'; 
    protected $db_name = 'contact';
    protected $username = 'root';
    protected $password = 'Magid';
    protected static $conn;
    function __construct(){
        try {
           self::$conn= new PDO("mysql:host=". $this->host .";dbname=".$this->db_name,$this->username,$this->password);
            } catch(PDOException $e) {
                echo "Connexion a la base de données echouer : " . $e->getMessage();
            }
}
}