<?php

class Base{

    public $db;

    public function __construct(){

  
        // Variables de connection
        $dbHost = "dunjeonxplorer-dunjeonxplorer.g.aivencloud.com:27061";
        $dbName = "DunjeonXplorer";
        $dbUser = "avnadmin";
        $dbPassword = "AVNS_yA4K7tJHMO3MqRheWWN";

        try {
            // Connexion à la base de données
            $this->db = new PDO('mysql:host=dunjeonxplorer-dunjeonxplorer.g.aivencloud.com:27061;dbname=DunjeonXplorer;charset=utf8', 'avnadmin', 'AVNS_yA4K7tJHMO3MqRheWWN');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion à la base de données réussie";
            echo "<script>console.log('Connexion à la base de données réussie');</script>";
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            echo "<script>console.log('Erreur de connexion à la base de données : " . $e->getMessage() . "');</script>";
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

