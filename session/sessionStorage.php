<?php
session_start();
require_once 'session/Inventory.php';
require_once 'session/Hero.php';
require_once 'base/Database.php';


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
        
        $base = $GLOBALS["base"];

        $hero = unserialize($_SESSION["hero"]);

        #update last chapter
        $base->request("UPDATE Quest SET chapter_id = {$_SESSION["chapter"]} WHERE hero_id = {$hero->id}");
    
        
        #update last hero state
        $base->request("UPDATE Hero SET pv = {$hero->pv}, mana = {$hero->mana}, strength = {$hero->strength}, initiative = {$hero->initiative}, shield = {$hero->shield}, am_id = {$hero->getArmor()->id}, primary_wp_id = {$hero->getPrimary()->id}, secondary_wp_id = {$hero->getSecondary()->id}, xp = {$hero->xp}, current_level = {$hero->current_level} WHERE id = {$hero->id}");
        
        //TODO store/update spell_list


        #update last inventory
        $base->request("DELETE FROM Inventory WHERE hero_id = {$hero->id}");
        $inventory = unserialize($_SESSION["inventory"]);

        if(isset($inventory->items)){
            foreach($inventory->items as &$item){
                $item = unserialize($item);
                $base->request("INSERT INTO Inventory(hero_id, item_id, qte) VALUES ({$hero->id}, {$item->id}, {$item->quantity})");
            }
            unset($item);
        }
        
        if(isset($inventory->weapons)){
            foreach($inventory->weapons as &$weapon){
                $weapon = unserialize($weapon);
                $base->request("INSERT INTO Inventory(hero_id, item_id, qte) VALUES ({$hero->id}, {$weapon->id}, {$weapon->quantity})");
                
            }
            unset($weapon);
        }
        
        if(isset($inventory->armors)){
            foreach($inventory->armors as &$armor){
                $armor = unserialize($armor);
                $base->request("INSERT INTO Inventory(hero_id, item_id, qte) VALUES ({$hero->id}, {$armors->id}, {$armors->quantity})");
            }
            unset($armor);
        }
  
    }


    #To load data from the database for the adventure/hero choosen
    static function loadData($heroID){
        $base = $GLOBALS["base"];
        
        #get last chapter
        $_SESSION["chapter"] = $base->request("SELECT chapter_id FROM Quest WHERE hero_id = {$heroID}");

        #get current adventure
        $_SESSION["adventure"] = $base->request("SELECT ad_id FROM Chapter WHERE id = {$_SESSION["chapterID"]}");

        #hero last state
        $heroData = $base->request("SELECT * FROM Hero JOIN Quest ON Hero.id = Quest.hero_id JOIN Chapter ON Chapter.id = Quest.chapter_id WHERE Hero.id = {$heroID} AND ad_id = {$_SESSION["adventure"]}");
        $_SESSION["hero"] = serialize(new Hero($heroData["id"],$heroData["name"],$heroData["class_id"],$heroData["pv"],$heroData["mana"],$heroData["strength"],$heroData["initiative"],$heroData["shield"], $heroData["spell_list"],$heroData["xp"],$heroData["current_level"],$heroData["armor_id"],$heroData["primary_wp_id"],$heroData["secondary_wp_id"],$heroData["weight_limit"],$heroData["qte_item_limit"]));
        
        
        #get inventory
        $items = [];
        $storedItems = $base->request("SELECT item_id, qte FROM Inventory WHERE item_id not in (SELECT item_id FROM Weapon) AND not in (SELECT item_id FROM Armor)");
        foreach($storedItems as &$storedItem){
            $newItem = Item::getItem($storedItem["item_id"]);
            $newItem->quantity = $storedItem["qte"];
            $items[] = serialize($newItem);
        }
        unset($storedItem);

        $weapons = [];
        $storedWeapons = $base->request("SELECT item_id, qte FROM Inventory WHERE item_id in (SELECT item_id FROM Weapon)");
        foreach($storedWeapons as &$storedWeapon){
            $newWeapon = Weapon::getWeapon($storedWeapon["item_id"]);
            $newWeapon->quantity = $storedWeapon["qte"];
            $weapons[] = serialize($newWeapon);
        }
        unset($storedWeapon);

        $armors = [];
        $storedArmors = $base->request("SELECT item_id, qte FROM Inventory WHERE item_id in (SELECT item_id FROM Armor)");
        foreach($storedArmors as &$storedArmor){
            $newArmor = Armor::getArmor($storedArmor["item_id"]);
            $newArmor->quantity = $storedArmor["qte"];
            $armors[] = serialize($newArmor);
        }
        unset($storedArmor);


        $_SESSION["inventory"] = serialize(new Inventory($items, $weapons, $armors));
        
    }

}