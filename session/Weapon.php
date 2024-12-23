<?php

require_once 'Item.php';

class Weapon extends Item{

    public $id;
    public $wptID;
    public $bonusStreagth;
    public $initiativePenalty;


    public function __construct($itemId, $itemName, $itemDescription, $itemWeight, $id, $wptID, $bonusStreagth, $initiativePenalty){
        Item::__construct($itemId, $itemName, $itemDescription, $itemWeight);
        
        $this->id = $id;
        $this->wptID = $wptID;
        $this->bonusStreagth = $bonusStreagth;
        $this->initiativePenalty = $initiativePenalty;
        
    }

    public static function getWeapon($id):Weapon{
        $weaponInfo = $GLOBALS["base"]->request("SELECT * FROM Weapon WHERE wp_id = {$id}")[0];
        $itemInfo = $GLOBALS["base"]->request("SELECT * FROM Items WHERE id = {$weaponInfo["item_id"]}")[0];
        return new Weapon($itemInfo["id"], $itemInfo["name"], $itemInfo["description"], $itemInfo["weight"], $id, $weaponInfo["wpt_id"], $weaponInfo["bonus_strength"], $weaponInfo["initiative_penalty"]);
    }

}