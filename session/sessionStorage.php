<?php

session_start();

#    $_SESSION DESCRIPTION
#  
#   "adventure" => int
#
#   "chapterID" => int
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
    

    static function saveData(){
        require_once '../base/Database.php';

        #update last chapter
        $base->request("UPDATE Quest SET chapter_id = {$_SESSION["chapterID"]} WHERE hero_id = {$_SESSION["hero"]->id}");
    
        #update last hero state
        $base->request("UPDATE Hero SET pv = {$_SESSION["hero"]->pv}, mana = {$_SESSION["hero"]->mana}, strength = {$_SESSION["hero"]->strength}, initiative = {$_SESSION["hero"]->initiative}, shield = {$_SESSION["hero"]->shield}, ar_id = {$_SESSION["hero"]->armor_id}, primary_wp_id = {$_SESSION["hero"]->primary_wp_id}, secondary_wp_id = {$_SESSION["hero"]->secondary_wp_id}, xp = {$_SESSION["hero"]->xp}, current_level = {$_SESSION["hero"]->current_level} WHERE id = {$_SESSION["hero"]->id}");
        //TODO store/update spell_list

        #update last inventory
        $inventory = $_SESSION["inventory"];

        #items
        foreach($inventory->items as &$item){

        }

        #weapons
        foreach($inventory->weapons as &$weapon){
            
        }

        #armors
        foreach($inventory->armors as &$armor){
            
        }


        unset($item);
        unset($weapon);
        unset($armor);
    }


    #Call when user choose character or else
    static function loadData($heroID){
        require_once '../base/Database.php';
        
        #get last chapter
        $_SESSION["chapterID"] = $base->request("SELECT chapter_id FROM Quest WHERE hero_id = {$heroID}");

        #get current adventure
        $_SESSION["adventure"] = $base->request("SELECT ad_id FROM Chapter WHERE id = {$_SESSION["chapterID"]}");

        #hero last state
        $heroData = $base->request("SELECT * FROM Hero JOIN Quest ON Hero.id = Quest.hero_id JOIN Chapter ON Chapter.id = Quest.chapter_id WHERE Hero.id = {$heroID} AND ad_id = {$_SESSION["adventure"]}");

        #get inventory
        $items = [];

        $weapon = [];

        $armors = [];


        $_SESSION["inventory"] = new Inventory($items, $weapon, $armor);
        
    }

}