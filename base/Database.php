<?php

class Base{

    public $db;

    public function __construct(){
  
        // Récupération des variables d'environnement
        $dbHost = "dunjeonxplorer-dunjeonxplorer.g.aivencloud.com";
        $dbPort = "27061";
        $dbName = "defaultdb";
        $dbUser = "avnadmin";
        $dbPassword = "AVNS_yA4K7tJHMO3MqRheWWN";

        try {
            // Connexion à la base de données
            $this->db = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
            // Définition des attributs de PDO pour afficher les erreurs
            echo "Succès";
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            exit;
        }
    }
        
    public function request($requestString){
        $res = $this->db->prepare($requestString);
        $res->execute();
        return $res->fetchAll();
    }
}

$GLOBALS["base"] = new Base();

