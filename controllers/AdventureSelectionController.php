<?php

class AdventureSelectionController{
    public function pullAdventure(){
        require_once 'base/Database.php';
        $adventure = $db->query("Select ad_id,ad_first_chapter,ad_name from Adventure");
        require "AdventureView.php";
    }
}