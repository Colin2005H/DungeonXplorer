<?php
require_once 'Hero.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $heroId = $_POST['hero_id'];

    if (!empty($heroId)) {
        //recuperer les données du hero selectionné
        $selectedHero = Hero::getHero($heroId);

       //je ne sais pas vers quelle page rediriger pour le moement


        exit();
    } else {
        echo "Veuillez sélectionner un héros.";
    }
}
