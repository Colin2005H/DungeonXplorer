<?php

abstract class Item {

    public $itemID;
    public $itemName;
    public $itemDescription;
    public $itemQuantity;

    public function __construct($itemID, $itemName, $itemDescription, $itemQuantity)
    {
        $this->itemID = $itemID;
        $this->itemName = $itemName;
        $this->itemDescription = $itemDescription;
        $this->itemQuantity = 1;
    }

}