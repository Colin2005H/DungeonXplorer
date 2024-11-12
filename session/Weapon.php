<?php

class Weapon extends Item{

    public $wptID;
    public $bonusStreagth;

    public function __construct($itemID, $itemName, $itemDescription, $wptID, $bonusStreagth){
        Item::__construct($itemID, $itemName, $itemDescription);
        
        $this->wptID = $wptID;
        $this->bonusStreagth = $bonusStreagth;
        
    }

}