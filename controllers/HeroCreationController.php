<?php
require_once "../base/Database.php";
require_once "../models/HeroCreation.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $biographie = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $classid = isset($_POST['classe']) ? htmlspecialchars(trim($_POST['classe'])) : '';
    if (empty($name) || empty($classid)) {
        echo "Tous les champs doivent être remplis.";
    } else {
        // Exemple de traitement : affichage des données
        $base = $GLOBALS["base"];
        $class = $base->request("SELECT * FROM class WHERE id = $classid");
        $base->request("INSERT INTO Hero (name,class_id,biographie,pv,mana,strenght,initiative,shield,xp,current_level,user_id,am_id,primary_wp_id,secondary_wp_id,wheight_limit,qte_item_limit) VALUES ($name,$classid,$biographie,{$class['base_pv']},{$class['base_mana']},{$class['base_strenght']},{$class['base_initiative']},{$class['base_shield']},0,1,{$_SESSION[user_id]}  ,{$class['base_armor']},{$class['base_primary_wp']},{$class['base_secondary_wp']},{$class['base_wheight_limit']},{$class['base_qte_item_limit']})");

        // Vous pouvez aussi enregistrer ces données dans une base de données
    }
}
?>