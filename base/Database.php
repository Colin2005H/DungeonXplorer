<?php

class Base{

    public $db;

    public function __construct()
    {
        // Chemin vers le fichier .env
        /*
        $envFile = "../base/.env";

        // Vérification de l'existence du fichier .env
        if (!file_exists($envFile)) {
            die("Le fichier .env n'existe pas.");
        }

        // Lecture du fichier .env et récupération des variables d'environnement
        $env = parse_ini_file($envFile);
        */

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
        $res = $this->db->prepare($requestString);
        $res->execute();
        return $res->fetchAll();
    }
}

$GLOBALS["base"] = new Base();

