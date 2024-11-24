<?php

class Armor extends Item{

    public $id;
    public $amtID;
    public $amPoint;
    public $initiativePenalty;

    public function __construct($itemId, $itemName, $itemDescription, $itemWeight, $id, $amtID, $amPoint, $initiativePenalty){
        Item::__construct($itemId, $itemName, $itemDescription, $itemWeight);
        
        $this->id = $id;
        $this->amtID = $amtID;
        $this->amPoint = $amPoint;
        $this->initiativePenalty = $initiativePenalty;
    }

    public static function getArmor($id):Armor{
        $armorInfo = $GLOBALS["base"]->request("SELECT * FROM Armor WHERE id = {$id}")[0];
        $itemInfo = $GLOBALS["base"]->request("SELECT * FROM Items WHERE id = {$armorInfo["item_id"]}")[0];
        return new Weapon($itemInfo["id"], $itemInfo["name"], $itemInfo["description"], $itemInfo["weight"], $id, $armorInfo["amt_id"], $armorInfo["am_point"], $armorInfo["initiative_penalty"]);
    }

}
