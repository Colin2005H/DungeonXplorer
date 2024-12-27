<?php

session_start();

require_once 'session/Inventory.php';
require_once 'session/Hero.php';


#    $_SESSION DESCRIPTION
#  
#   "adventure" => int
#
#   "chapter" => int
#
#   "hero" => Hero{...}
#   
#   "inventory" =>Inventory{
#       
#       items => Array{
#            0 => Item{}
#            1 => ...
#       }
#       weapons => Array{
#            0 => Weapon{}
#            1 => ...
#       }
#       armors => Armor{
#            0 => Armor{}
#            1 => ...
#       }
#   }
  


class Session{
    

    #To save current adventure/hero progresse in the database
    static function saveData(){
        require_once '../base/Database.php';
        $base = $GLOBALS["base"];


        #update last chapter
        $base->request("UPDATE Quest SET chapter_id = {$_SESSION["chapter"]} WHERE hero_id = {$_SESSION["hero"]->id}");
    

        #update last hero state
        $base->request("UPDATE Hero SET pv = {$_SESSION["hero"]->pv}, mana = {$_SESSION["hero"]->mana}, strength = {$_SESSION["hero"]->strength}, initiative = {$_SESSION["hero"]->initiative}, shield = {$_SESSION["hero"]->shield}, ar_id = {$_SESSION["hero"]->armor->id}, primary_wp_id = {$_SESSION["hero"]->primary_wp->id}, secondary_wp_id = {$_SESSION["hero"]->secondary_wp->id}, xp = {$_SESSION["hero"]->xp}, current_level = {$_SESSION["hero"]->current_level} WHERE id = {$_SESSION["hero"]->id}");
        
        //TODO store/update spell_list


        #update last inventory
        $base->request("DELETE FROM Inventory WHERE hero_id = {$_SESSION["hero"]->id}");
        $inventory = $_SESSION["inventory"];

        foreach($inventory->items as &$item){
            $base->request("INSERT INTO Inventory(hero_id, item_id, qte) VALUES ({$_SESSION["hero"]->id}, {$item->id}, {$item->quantity})");
        }
        foreach($inventory->weapons as &$weapon){
            $base->request("INSERT INTO Inventory(hero_id, item_id, qte) VALUES ({$_SESSION["hero"]->id}, {$weapon->id}, {$weapon->quantity})");
        }
        foreach($inventory->armors as &$armor){
            $base->request("INSERT INTO Inventory(hero_id, item_id, qte) VALUES ({$_SESSION["hero"]->id}, {$armors->id}, {$armors->quantity})");
        }
        unset($item);
        unset($weapon);
        unset($armor);
    }


    #To load data from the database for the adventure/hero choosen
    static function loadData($heroID){
        require_once '../base/Database.php';
        $base = $GLOBALS["base"];
        
        #get last chapter
        $_SESSION["chapter"] = $base->request("SELECT chapter_id FROM Quest WHERE hero_id = {$heroID}");

        #get current adventure
        $_SESSION["adventure"] = $base->request("SELECT ad_id FROM Chapter WHERE id = {$_SESSION["chapterID"]}");

        #hero last state
        $heroData = $base->request("SELECT * FROM Hero JOIN Quest ON Hero.id = Quest.hero_id JOIN Chapter ON Chapter.id = Quest.chapter_id WHERE Hero.id = {$heroID} AND ad_id = {$_SESSION["adventure"]}");
        $_SESSION["hero"] = new Hero($heroData["id"],$heroData["name"],$heroData["class_id"],$heroData["pv"],$heroData["mana"],$heroData["strength"],$heroData["initiative"],$heroData["shield"], $heroData["spell_list"],$heroData["xp"],$heroData["current_level"],$heroData["armor_id"],$heroData["primary_wp_id"],$heroData["secondary_wp_id"],$heroData["weight_limit"],$heroData["qte_item_limit"]);
        
        
        #get inventory
        $items = [];
        $storedItems = $base->request("SELECT item_id, qte FROM Inventory WHERE item_id not in (SELECT item_id FROM Weapon) AND not in (SELECT item_id FROM Armor)");
        foreach($storedItems as &$storedItem){
            $newItem = Item::getItem($storedItem["item_id"]);
            $newItem->quantity = $storedItem["qte"];
            $items[] = $newItem;
        }
        unset($storedItem);

        $weapons = [];
        $storedWeapons = $base->request("SELECT item_id, qte FROM Inventory WHERE item_id in (SELECT item_id FROM Weapon)");
        foreach($storedWeapons as &$storedWeapon){
            $newWeapon = Weapon::getWeapon($storedWeapon["item_id"]);
            $newWeapon->quantity = $storedWeapon["qte"];
            $weapons[] = $newWeapon;
        }
        unset($storedWeapon);

        $armors = [];
        $storedArmors = $base->request("SELECT item_id, qte FROM Inventory WHERE item_id in (SELECT item_id FROM Armor)");
        foreach($storedArmors as &$storedArmor){
            $newArmor = Armor::getArmor($storedArmor["item_id"]);
            $newArmor->quantity = $storedArmor["qte"];
            $armors[] = $newArmor;
        }
        unset($storedArmor);


        $_SESSION["inventory"] = new Inventory($items, $weapons, $armors);
        
    }

}