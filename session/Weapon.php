<?php

class Weapon extends Item{

    public $id;
    public $wptID;
    public $bonusStrength;
    public $initiativePenalty;
    public $typeLabel;


    public function __construct($itemId, $itemName, $itemDescription, $itemWeight, $id, $wptID, $bonusStrength, $initiativePenalty,$typeLabel){
        Item::__construct($itemId, $itemName, $itemDescription, $itemWeight);
        
        $this->id = $id;
        $this->wptID = $wptID;
        $this->bonusStrength = $bonusStrength;
        $this->initiativePenalty = $initiativePenalty;
        $this->typeLabel = $typeLabel;
        
    }

    public static function getWeapon($id):Weapon{
        $weaponInfo = $GLOBALS["base"]->request("SELECT * FROM Weapon WHERE wp_id = {$id}")[0];
        $itemInfo = $GLOBALS["base"]->request("SELECT * FROM Items WHERE id = {$weaponInfo["item_id"]}")[0];
        $typeInfo = $GLOBALS["base"]->request("SELECT label FROM Weapon_Type WHERE wpt_id = {$weaponInfo["wpt_id}")[0];
        return new Weapon($itemInfo["id"], $itemInfo["name"], $itemInfo["description"], $itemInfo["weight"], $id, $weaponInfo["wpt_id"], $weaponInfo["bonus_strength"], $weaponInfo["initiative_penalty"],$typeInfo["label"]);
    }

}