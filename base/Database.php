<?php

class Base{

    public $db;

    public function __construct(){

        // Récupération des variables d'environnement
        $dbHost = "mysql-etu.unicaen.fr";
        $dbName = "legoupi231_0";
        $dbUser = "legoupi231";
        $dbPassword = "rahgho1os0ieDeix";

        try {
            // Connexion à la base de données
            $this->db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
            // Définition des attributs de PDO pour afficher les erreurs
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            exit;
        }
    }
        
    public function request($requestString){
        try {
            $res = $this->db->prepare($requestString);
            $res->execute();
            return $res->fetchAll();
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
            exit;
        }
    }
    
}

$GLOBALS["base"] = new Base();

