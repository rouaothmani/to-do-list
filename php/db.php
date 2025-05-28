<?php
// Informations de connexion à la base de données
$host = 'localhost'; // Hôte de la base de données
$user = 'root'; // Nom d'utilisateur de la base de données
$pass = '' ; // Mot de passe de la base de données (vide par défaut dans EasyPHP)
$db = 'projet'; // Nom de la base de données
// Connexion à la base de données
$conn=new mysqli($host,$user,$pass,$db);
    if($conn->connect_error){
        die("Erreur de connexion: ". $conn->connect_error);
    }

?>