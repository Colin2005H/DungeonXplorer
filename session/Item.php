<?php

abstract class Item {

    public $itemID;
    public $itemName;
    public $itemDescription;
    public $itemQuantity;

    public function __construct($itemID, $itemName, $itemDescription)
    {
        $this->itemID = $itemID;
        $this->itemName = $itemName;
        $this->itemDescription = $itemDescription;
        $this->itemQuantity = 1;
    }

    public function increaseStack($val){
        $this->itemQuantity + $val;
    }

    public function decreaseStack($val){
        $this->itemQuantity - $val;
    }

}