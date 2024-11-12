<?php

class Armor extends Item{
    public $amtID;
    public $amPoint;

    public function __construct($itemID, $itemName, $itemDescription,$amtID, $amPoint){
        Item::__construct($itemID, $itemName, $itemDescription);
        
        $this->amtID = $amtID;
        $this->amPoint = $amPoint;
        
    }

}
